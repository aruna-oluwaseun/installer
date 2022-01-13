<?php

/**
 * Get user | default:current user
 */
if( !function_exists('get_user') )
{
    function get_user($user_id = false) {

        if(!$user_id)
        {
            return \Illuminate\Support\Facades\Auth::user();
        }

        return \App\Models\User::find($user_id);
    }
}

if(!function_exists('account_type'))
{
    function account_type() : string
    {
        if(session()->exists('account_type'))
        {
            return session()->get('account_type');
        }

        return '';
    }
}

if(!function_exists('is_installer'))
{
    function is_installer() : bool
    {
        if(!is_logged_in())
        {
            return false;
        }

        return account_type() == 'installer';
    }
}

if(!function_exists('is_customer'))
{
    function is_customer() : bool
    {
        if(!is_logged_in())
        {
            return false;
        }

        return account_type() == 'customer';
    }
}

/**
 * Get Company
 */
if( !function_exists('get_company') )
{
    function get_company($company_id = false) {

        if(!$company_id)
        {
            return \App\Models\Company::where('user_id',current_user_id())->first();
        }

        return \App\Models\Company::find($company_id);
    }
}

/**
 * Get user id
 */
if( !function_exists('current_user_id') )
{
    function current_user_id() {

        if($user = \Illuminate\Support\Facades\Auth::user())
        {
            return $user->id;
        }

        return false;
    }
}

/**
 * Get company user id
 */
if( !function_exists('current_user_company_id') )
{
    function current_user_company_id() {

        if($company = \App\Models\Company::where('user_id',current_user_id())->select('id')->first())
        {
            return $company->id;
        }

        return false;
    }
}

/**
 * Find out if they are logged in
 */
if( !function_exists('is_logged_in'))
{
    function is_logged_in() {
        return \Illuminate\Support\Facades\Auth::check();
    }
}

if(!function_exists('record_stat'))
{
    function record_stat($company_id, $type)
    {
        return \App\Models\CompanyStat::record($company_id, $type);
    }
}
