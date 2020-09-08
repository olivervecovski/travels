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
      if($this->image && $this->image !== '') {
        return $this->image;
      } else if($this->provider_image && $this->provider_image !== '') {
        return $this->provider_image;
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
          $uri = 'http://www.gravatar.com/avatar/' . md5(strtolower(Str::random(12)));
        }
      } catch(Exception $e) {
        $uri = 'http://www.gravatar.com/avatar/' . md5(strtolower(Str::random(12))) . '?d=identicon';
      }
      

      return $uri;
    }
}