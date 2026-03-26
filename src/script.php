<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.MokoCassiopeia
 *
 * @copyright   (C) 2026 Moko Consulting <hello@mokoconsulting.tech>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Template install/update/uninstall script.
 *
 * Joomla calls the methods in this class automatically during template
 * install, update, and uninstall via the <scriptfile> element in
 * templateDetails.xml.
 *
 * Joomla 5 and 6 compatible — uses the InstallerScriptInterface when
 * available, falls back to the legacy class-based approach otherwise.
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Installer\InstallerAdapter;
use Joomla\CMS\Log\Log;

class Tpl_MokocassiopeiaInstallerScript
{
    /**
     * Minimum PHP version required by this template.
     */
    private const MIN_PHP = '8.1.0';

    /**
     * Minimum Joomla version required by this template.
     */
    private const MIN_JOOMLA = '4.4.0';

    /**
     * Called before install/update/uninstall.
     *
     * @param   string            $type     install, update, discover_install, or uninstall.
     * @param   InstallerAdapter  $parent   The adapter calling this method.
     *
     * @return  bool  True to proceed, false to abort.
     */
    public function preflight(string $type, InstallerAdapter $parent): bool
    {
        if (version_compare(PHP_VERSION, self::MIN_PHP, '<')) {
            Factory::getApplication()->enqueueMessage(
                sprintf(
                    'MokoCassiopeia requires PHP %s or later. You are running PHP %s.',
                    self::MIN_PHP,
                    PHP_VERSION
                ),
                'error'
            );
            return false;
        }

        if (version_compare(JVERSION, self::MIN_JOOMLA, '<')) {
            Factory::getApplication()->enqueueMessage(
                sprintf(
                    'MokoCassiopeia requires Joomla %s or later. You are running Joomla %s.',
                    self::MIN_JOOMLA,
                    JVERSION
                ),
                'error'
            );
            return false;
        }

        return true;
    }

    /**
     * Called after a successful install.
     *
     * @param   InstallerAdapter  $parent  The adapter calling this method.
     *
     * @return  bool
     */
    public function install(InstallerAdapter $parent): bool
    {
        $this->logMessage('MokoCassiopeia template installed.');
        return true;
    }

    /**
     * Called after a successful update.
     *
     * This is where the CSS variable sync runs — it detects variables that
     * were added in the new version and injects them into the user's custom
     * palette files without overwriting existing values.
     *
     * @param   InstallerAdapter  $parent  The adapter calling this method.
     *
     * @return  bool
     */
    public function update(InstallerAdapter $parent): bool
    {
        $this->logMessage('MokoCassiopeia template updated.');

        // Run CSS variable sync to inject any new variables into user's custom palettes.
        $synced = $this->syncCustomVariables($parent);

        if ($synced > 0) {
            Factory::getApplication()->enqueueMessage(
                sprintf(
                    'MokoCassiopeia: %d new CSS variable(s) were added to your custom palette files. '
                    . 'Review them in your light.custom.css and/or dark.custom.css to customise the new defaults.',
                    $synced
                ),
                'notice'
            );
        }

        return true;
    }

    /**
     * Called after a successful uninstall.
     *
     * @param   InstallerAdapter  $parent  The adapter calling this method.
     *
     * @return  bool
     */
    public function uninstall(InstallerAdapter $parent): bool
    {
        $this->logMessage('MokoCassiopeia template uninstalled.');
        return true;
    }

    /**
     * Called after install/update completes (regardless of type).
     *
     * @param   string            $type    install, update, or discover_install.
     * @param   InstallerAdapter  $parent  The adapter calling this method.
     *
     * @return  bool
     */
    public function postflight(string $type, InstallerAdapter $parent): bool
    {
        return true;
    }

    /**
     * Run the CSS variable sync utility.
     *
     * Loads sync_custom_vars.php from the template directory and calls
     * MokoCssVarSync::run() to detect and inject missing variables.
     *
     * @param   InstallerAdapter  $parent  The adapter calling this method.
     *
     * @return  int  Number of variables added across all files.
     */
    private function syncCustomVariables(InstallerAdapter $parent): int
    {
        $templateDir = $parent->getParent()->getPath('source');

        // The sync script lives alongside this script in the template root.
        $syncScript = $templateDir . '/sync_custom_vars.php';

        if (!is_file($syncScript)) {
            $this->logMessage('CSS variable sync script not found at: ' . $syncScript, 'warning');
            return 0;
        }

        require_once $syncScript;

        if (!class_exists('MokoCssVarSync')) {
            $this->logMessage('MokoCssVarSync class not found after loading script.', 'warning');
            return 0;
        }

        try {
            $joomlaRoot = JPATH_ROOT;
            $results = MokoCssVarSync::run($joomlaRoot);

            $totalAdded = 0;
            foreach ($results as $filePath => $result) {
                $totalAdded += count($result['added']);
                if (!empty($result['added'])) {
                    $this->logMessage(
                        sprintf(
                            'CSS sync: added %d variable(s) to %s',
                            count($result['added']),
                            basename($filePath)
                        )
                    );
                }
            }

            return $totalAdded;
        } catch (\Throwable $e) {
            $this->logMessage('CSS variable sync failed: ' . $e->getMessage(), 'error');
            return 0;
        }
    }

    /**
     * Log a message to Joomla's log system.
     *
     * @param   string  $message   The log message.
     * @param   string  $priority  Log priority (info, warning, error).
     */
    private function logMessage(string $message, string $priority = 'info'): void
    {
        $priorities = [
            'info'    => Log::INFO,
            'warning' => Log::WARNING,
            'error'   => Log::ERROR,
        ];

        Log::addLogger(
            ['text_file' => 'mokocassiopeia.log.php'],
            Log::ALL,
            ['mokocassiopeia']
        );

        Log::add($message, $priorities[$priority] ?? Log::INFO, 'mokocassiopeia');
    }
}
