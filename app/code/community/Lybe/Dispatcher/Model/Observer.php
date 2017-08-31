<?php

class Lybe_Dispatcher_Model_Observer
{
    // Account actions
    const CUSTOMER_PAGE = "customer_account_login";
    const CUSTOMER_CREATE = "customer_account_create";
    const CUSTOMER_ACCOUNT_INDEX = "customer_account_index";
    const CUSTOMER_LOGOUT_SUCCESS = "customer_account_logoutSuccess";
    const CUSTOMER_LOGIN_POST = "customer_account_loginPost";
    const CUSTOMER_ACCOUNT_LOGOUT = "customer_account_logout";
    const CUSTOMER_ACCOUNT_FORGOT_PASSWORD = "customer_account_forgotpassword";
    const CUSTOMER_ACCOUNT_FORGOT_PASSWORD_POST = "customer_account_forgotpasswordpost";

    private $_deniedActions = array(
        self::CUSTOMER_PAGE,
        self::CUSTOMER_CREATE,
        self::CUSTOMER_ACCOUNT_INDEX,
        self::CUSTOMER_LOGOUT_SUCCESS,
        self::CUSTOMER_LOGIN_POST,
        self::CUSTOMER_ACCOUNT_LOGOUT,
        self::CUSTOMER_ACCOUNT_FORGOT_PASSWORD,
        self::CUSTOMER_ACCOUNT_FORGOT_PASSWORD_POST
    );

    public function hookToControllerActionPreDispatch(Varien_Event_Observer $observer)
    {
        $action = $observer->getEvent()->getControllerAction()->getFullActionName();

        if (in_array($action, $this->_deniedActions)) {
            $this->_redirectToStartPage();
        }
    }
    
    private function _redirectToStartPage()
    {
        return Mage::app()->getFrontController()->getResponse()->setRedirect('/')->sendResponse();
    }
}
