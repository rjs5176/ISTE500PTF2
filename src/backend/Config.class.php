<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * INS WEBNOC API
 *
 * User: lromero
 * Date: 4/05/2019
 * Time: 3:52 PM
 */

/**
 * Class Config
 * Configuration options
 */
abstract class Config // THIS FILE MUST BE RENAMED Config.class.php
{
    const OPTIONS = array(
        'baseURI' => '/ic/',

        'databaseHost' => 'localhost',
        'databaseName' => 'ws_piratetoyfund',
        'databaseUser' => 'ws-piratetoyfund',
        'databasePassword' => 'piratetoyfundDBpw2020',

        'salt' => '50d059db990556b3114774cf164619e3caf8a84e6fd52ca60c8fc1c6c071b404197e24d2e3707e24915f65f03ff036c5a22a809d9ef40e139a80b36e42c39446',
        'allowMultipleSessions' => FALSE,

        // Define extensions to be enabled
        'enabledExtensions' => array(
            'trs'
        ),

        'ldapEnabled' => FALSE,
        'ldapFilter' => '', // Filter for user lookup
        'ldapVersion' => 3, // LDAP version, use '3' for Active Directory
        'ldapDomainController' => 'domain.local',
        'ldapDomain' => 'DOMAIN', // Domain prefix for user accounts
        'ldapDomainDn' => 'dc=domain, dc=local',
        'ldapPrincipalSuffix' => '@domain.local',

        'ldapUsername' => 'domain_admin',
        'ldapPassword' => 'domain_password',

        'emailEnabled' => FALSE,
        'emailHost' => 'ssl://email_server',
        'emailPort' => 000,
        'emailAuth' => TRUE,
        'emailUsername' => 'email_username',
        'emailPassword' => 'email_password',
        'emailFromAddress' => 'some@email.com',
        'emailFromName' => 'Some Name',

        'sshKeyPath' => '', // Path to SSH key for remote servers
    );
}