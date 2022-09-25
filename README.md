# User Service

## Requirements
* php v8.1
* composer v2.4


## Installation
1. composer install
2. vendor/bin/phpunit --configuration phpunit.xml

## Use Cases

* **CreateUser** - Create user will create a new user, and provision an organization. The provisioned organization will have an organization
                   name of the users email.

  #### Pre-conditions:
    - The user does not exist
    - An organization does not exist with the users email (To be used as the organization's name)
                    
  #### RequestModel:
  - email


* **GetOrganization** - Get a single organization for the given user.

  #### RequestModel:
    - userId
    - organizationId


* **GetOrganization** - Get organization for the given user.

  #### RequestModel:
    - userId
    - organizationId


* **InviteUserToOrganization** - Invite a user to a organization.

  #### Pre-conditions:
    - The organization is active

  #### RequestModel:
  - organizationId
  - inviteeEmail


* **RegisterUserToOrganization** - Register a user to an organization based on invitation.

  #### Pre-conditions:
    - The organization is active
    - The user is enabled

  #### RequestModel:
    - organizationId
    - inviteeEmail


* **RequestTransferOfOrganization** - Request transfer of an organization to another user.

  #### Pre-conditions:
    - The receiver is a member of the organization
    - The organization is active
    - The receiver is enabled

  #### RequestModel:
    - organizationId
    - userId


* **AcceptOrganizationTransfer** - Accept the transfer of an organization.

  #### Pre-conditions:
    - The receiver is a member of the organization
    - The organization is active
    - The receiver is enabled

  #### RequestModel:
    - organizationId
    - userId


* **RejectOrganizationTransfer** - Reject the transfer of an organization.

  #### RequestModel:
    - organizationId
    - userId


* **CancelOrganizationTransfer** - Cancel the transfer of an organization.

  #### Pre-conditions:
    - The organization is active
    - The user is enabled

  #### RequestModel:
    - organizationId
    - userId


* **ChangeOrganizationName** - Change an organization name.

  #### Pre-conditions:
    - The user is active
    - The organization is active
    - The name is not already in use

  #### RequestModel:
    - organizationId
    - userId
    - name

    
* **CloseOrganization** - Close a organization

    #### Pre-conditions:
    - The user is active

   #### RequestModel:
    - organizationId
    - userId