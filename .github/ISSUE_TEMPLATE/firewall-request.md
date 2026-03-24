---
name: Firewall Request
about: Request firewall rule changes or access to external resources
title: '[FIREWALL] [Resource Name] - [Brief Description]'
labels: ['firewall-request', 'infrastructure', 'security']
assignees: []
---

<!--
SPDX-License-Identifier: GPL-3.0-or-later
Copyright (C) 2024-2026 Moko Consulting Tech

File: .github/ISSUE_TEMPLATE/firewall-request.md
Description: Issue template for firewall rule change and access requests
Project: .github-private
Author: Moko Consulting Tech
Version: 03.02.00

Revision History:
- 2026-03-11: Added SPDX header and version to match MokoStandards 03.02.00
-->

## Firewall Request

### Request Type
- [ ] Allow outbound access to external service/API
- [ ] Allow inbound access from external source
- [ ] Modify existing firewall rule
- [ ] Remove/revoke firewall rule
- [ ] Other (specify):

### Resource Information
**Service/Domain Name**: 
**IP Address(es)**: 
**Port(s)**: 
**Protocol**: 
- [ ] HTTP (80)
- [ ] HTTPS (443)
- [ ] SSH (22)
- [ ] FTP (21)
- [ ] SFTP (22)
- [ ] Custom (specify): _______________

### Requestor Information
**Name**: 
**GitHub Username**: @
**Email**: @mokoconsulting.tech
**Team/Department**: 
**Manager**: @

### Business Justification
**Why is this access needed?**

**Which project(s) require this access?**

**What functionality will break without this access?**

**Is there an alternative solution?**
- [ ] Yes (explain): 
- [ ] No

### Security Considerations
**Data Classification**:
- [ ] Public
- [ ] Internal
- [ ] Confidential
- [ ] Restricted

**Sensitive Data Transmission**:
- [ ] No sensitive data will be transmitted
- [ ] Sensitive data will be transmitted (encryption required)
- [ ] Authentication credentials will be transmitted (secure storage required)

**Third-Party Service**:
- [ ] This is a trusted/verified third-party service
- [ ] This is a new/unverified service (security review required)

**Service Documentation**: 
(Provide link to service documentation or API specs)

### Access Scope
**Affected Systems**:
- [ ] Development environment only
- [ ] Staging environment only
- [ ] Production environment
- [ ] All environments

**Access Duration**:
- [ ] Permanent (ongoing business need)
- [ ] Temporary (specify end date): _______________
- [ ] Testing only (specify duration): _______________

### Technical Details
**Source System(s)**: 
(Which internal systems need access?)

**Destination System(s)**: 
(Which external systems need to be accessed?)

**Expected Traffic Volume**: 
(e.g., requests per hour/day)

**Traffic Pattern**:
- [ ] Continuous
- [ ] Periodic (specify frequency): _______________
- [ ] On-demand/manual
- [ ] Scheduled (specify schedule): _______________

### Testing Requirements
**Pre-Production Testing**:
- [ ] Request includes dev/staging access for testing
- [ ] Testing can be done with production access only
- [ ] No testing required (modify existing rule)

**Testing Plan**:

**Rollback Plan**:
(What happens if access needs to be revoked?)

### Compliance & Audit
**Compliance Requirements**:
- [ ] GDPR considerations
- [ ] SOC 2 compliance required
- [ ] PCI DSS considerations
- [ ] Other regulatory requirements: _______________
- [ ] No specific compliance requirements

**Audit/Logging Requirements**:
- [ ] Standard logging sufficient
- [ ] Enhanced logging/monitoring required
- [ ] Real-time alerting required

### Urgency
- [ ] Critical (production down, immediate access needed)
- [ ] High (needed within 24 hours)
- [ ] Normal (needed within 1 week)
- [ ] Low priority (needed within 1 month)

**If critical/high urgency, explain why:**

### Approvals
**Manager Approval**: 
- [ ] Manager has been notified and approves this request

**Security Team Review Required**:
- [ ] Yes (new external service, sensitive data)
- [ ] No (minor change, established service)

### Additional Information

**Related Documentation**:
(Links to relevant docs, RFCs, tickets, etc.)

**Dependencies**:
(Other systems or changes this depends on)

**Comments/Questions**:

---

## For Infrastructure/Security Team Use Only

**Do not edit below this line**

### Security Review
- [ ] Security team review completed
- [ ] Risk assessment: Low / Medium / High
- [ ] Encryption required: Yes / No
- [ ] VPN required: Yes / No
- [ ] Additional security controls: _______________

**Reviewed By**: @_______________
**Review Date**: _______________
**Review Notes**:

### Implementation
- [ ] Firewall rule created/modified
- [ ] Rule tested in dev/staging
- [ ] Rule deployed to production
- [ ] Monitoring/alerting configured
- [ ] Documentation updated

**Firewall Rule ID**: _______________
**Implementation Date**: _______________
**Implemented By**: @_______________

**Configuration Details**:
```
Source: 
Destination: 
Port/Protocol: 
Action: Allow/Deny
```

### Verification
- [ ] Requestor confirmed access working
- [ ] Logs reviewed (no anomalies)
- [ ] Security scan completed (if applicable)

**Verification Date**: _______________
**Verified By**: @_______________

### Notes
