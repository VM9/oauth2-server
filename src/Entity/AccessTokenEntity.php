<?php

/**
 * OAuth 2.0 Access token entity
 *
 * @package     league/oauth2-server
 * @author      Alex Bilbie <hello@alexbilbie.com>
 * @copyright   Copyright (c) Alex Bilbie
 * @license     http://mit-license.org/
 * @link        https://github.com/thephpleague/oauth2-server
 */

namespace League\OAuth2\Server\Entity;

/**
 * Access token entity class
 */
class AccessTokenEntity extends AbstractTokenEntity {

    /**
     * Get session
     *
     * @return \League\OAuth2\Server\Entity\SessionEntity
     */
    public function getSession() {
        if ($this->session instanceof SessionEntity) {
            return $this->session;
        }

        $this->session = $this->server->getSessionStorage()->getByAccessToken($this);

        return $this->session;
    }

    /**
     * Check if access token has an associated scope
     *
     * @param string $scope Scope to check
     *
     * @return bool
     */
    public function hasScope($scope) {
        if ($this->scopes === null) {
            $this->getScopes();
        }

        return isset($this->scopes[$scope]);
    }

    /**
     * Return all scopes associated with the access token
     *
     * @return \League\OAuth2\Server\Entity\ScopeEntity[]
     */
    public function getScopes() {
        if ($this->scopes === null) {
            $this->scopes = $this->formatScopes(
                    $this->server->getAccessTokenStorage()->getScopes($this)
            );
        }

        return $this->scopes;
    }

    /**
     * {@inheritdoc}
     */
    public function save() {
        $this->server->getAccessTokenStorage()->create(
                $this->getId(), $this->getExpireTime(), $this->getSession()->getId()
        );

        //Muito lento criar a associativa entre sessão e token, e não há uso no scopo do figuardian.

        //Inicia a sessão baseada no id do accesstoken
//        if (session_status() == PHP_SESSION_NONE) {
//            $config = \Application\Main::getConfig();
//            \Application\Security\SessionManager::$_id = $this->getId();
//            \Application\Security\SessionManager::sessionStart($config->get('sys.codename'));
//        }
//
//        $this->server->getAccessTokenStorage()->getScopes($this); //Então eu forço a geração do cache em sessão para os scopes.
        // Associate the scope with the token
//        foreach ($this->getScopes() as $scope) {
//            $this->server->getAccessTokenStorage()->associateScope($this, $scope);
//        }
//        exit;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function expire() {
        $this->server->getAccessTokenStorage()->delete($this);
    }

}
