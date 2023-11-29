<?php

namespace VulcanPhp\Core\Auth\Drivers;

use Models\User;
use VulcanPhp\Core\Auth\Interfaces\IAuthDriver;
use VulcanPhp\Core\Auth\Traits\CacheAuth;
use VulcanPhp\Core\Auth\Traits\CookieAuth;
use VulcanPhp\Core\Helpers\Session;

class BasicAuthDriver implements IAuthDriver
{
    use CacheAuth, CookieAuth;

    protected  ?User $user = null;

    public function checkUser(): self
    {
        // start session for use
        Session::start();

        // WARNING: This is Un-Secure to Use Cookie Auth to remember logged user
        // use cookie auth <START>
        if (!Session::has('user') && $this->HasCookieAuth())
            Session::set('user', $this->GetCookieAuth());
        // use cookie auth <END>

        // check if logged user
        if (Session::has('user')) {

            // $user = User::find(intval(Session::get('user')));
            /**
             * @var $user
             *
             * use this $user variable instead of cache auth code
             */

            // WARNING: This is Un-Secure to Use Cache to Store Authenticate User Data
            // use cache for authenticate user <START>
            $id = intval(Session::get('user'));

            $this->InitCacheAuth();

            if ($this->HasCacheUser($id))
                $user = $this->GetCacheUser($id);
            else {
                $user = User::find($id);

                if ($user !== false) {
                    $this->SetCacheUser($user);
                }
            }

            $this->CloseCacheDB();
            // use cache for authenticate user <END>

            // set or remove current user
            if ($user !== false) {
                $this->user = $user;
            } else {
                $this->removeUser();
            }

            // remove temp $user
            unset($user);
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user ?? null;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        Session::set('user', $this->user->id);

        $this->SetCookieAuth($this->user->id);

        return $this;
    }

    public function removeUser(): self
    {
        $id = intval($this->user?->id);

        if ($id > 0) {
            $this->StartCacheDB()->RemoveCacheUser($id)->CloseCacheDB();
            $this->RemoveCookieAuth($id);
        }

        Session::remove('user');

        $this->user = null;

        return $this;
    }
}
