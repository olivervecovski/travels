<?php

namespace App\Traits;

use Exception;
use GuzzleHttp\Client;
use Str;

trait HasAvatar {
  /**
     * The attribute name containing the email address.
     *
     * @var string
     */
    public $gravatarEmail = 'email';
    public $hasAvatar = false;

    /**
     * Get the model's avatar
     *
     * @return string
     */
    public function getAvatarAttribute()
    {
      if($this->user_profile->image && $this->user_profile_image !== '') {
        return $this->user_profile->image;
      } else if($this->user_profile->provider_image && $this->user_profile->provider_image !== '') {
        return $this->user_profile->provider_image;
      }

      return $this->get_gravatar();
    }

    private function get_gravatar() {
      $hash = md5(strtolower(trim($this->attributes[$this->gravatarEmail])));
      $client = new Client();
      $uri = 'http://www.gravatar.com/avatar/' . $hash;
      try {
        $res = $client->request('GET', $uri . '?d=404');
        if ($res->getStatusCode() != 200) {
          $uri = 'http://www.gravatar.com/avatar/' . md5(strtolower($this->email)) . '?d=identicon';
        }
      } catch(Exception $e) {
        $uri = 'http://www.gravatar.com/avatar/' . md5(strtolower($this->email)) . '?d=identicon';
      }
      

      return $uri;
    }
}