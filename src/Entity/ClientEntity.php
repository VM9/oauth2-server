<?php

/**
 * OAuth 2.0 Client entity
 *
 * @package     league/oauth2-server
 * @author      Alex Bilbie <hello@alexbilbie.com>
 * @copyright   Copyright (c) Alex Bilbie
 * @license     http://mit-license.org/
 * @link        https://github.com/thephpleague/oauth2-server
 */

namespace League\OAuth2\Server\Entity;

use League\OAuth2\Server\AbstractServer;

/**
 * Client entity class
 */
class ClientEntity {

    use EntityTrait;

    /**
     * Client identifier
     *
     * @var string
     */
    protected $id = null;

    /**
     * Client secret
     *
     * @var string
     */
    protected $secret = null;

    /**
     * Client name
     *
     * @var string
     */
    protected $name = null;

    /**
     * Client redirect URI
     *
     * @var string
     */
    protected $redirectUri = null;

    /**
     * Authorization or resource server
     *
     * @var \League\OAuth2\Server\AbstractServer
     */
    protected $server;

    /**
     * Default language from client
     * @var type string
     */
    private $i18n = "pt-br";

    /**
     * Instituition id
     * @var type 
     */
    private $institution_id = null;

    /**
     * __construct
     *
     * @param \League\OAuth2\Server\AbstractServer $server
     *
     * @return self
     */
    public function __construct(AbstractServer $server) {
        $this->server = $server;

        return $this;
    }

    /**
     * Return the client identifier
     *
     * @return string
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Return the client secret
     *
     * @return string
     */
    public function getSecret() {
        return $this->secret;
    }

    /**
     * Get the client name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Return the client redirect URI
     *
     * @return string
     */
    public function getRedirectUri() {
        return $this->redirectUri;
    }

    /**
     * Return client default language in i18n format
     * @return type
     */
    public function geti18n() {
        $defaultLang = \Application\Main::$_config->get('sys.i18n');
        return (empty($this->i18n))? $defaultLang : $this->i18n;        
    }

    /**
     * Return client default language in i18n format
     * @return type
     */
    public function getInstitutionId() {
        return $this->institution_id;
    }
}
