<?php

namespace App\Traits;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
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
        return $this->get_avatar('avatars/' .$this->user_profile->image_filename);
    }

    private function get_avatar($path) {

      if(!$this->user_profile->image || $this->user_profile->image === '') {
        return $this->get_provider_avatar();
      }

      $disk = Storage::disk('s3');

      if($disk->exists($path)) {
        $s3_client = $disk->getDriver()->getAdapter()->getClient();
        $command = $s3_client->getCommand(
          'GetObject',
          [
            'Bucket' => env('AWS_BUCKET'),
            'Key' => $path,
            'ResponseContentDisposition' => 'attachment;'
          ]
          );

          $request = $s3_client->createPresignedRequest($command, '+5 minutes');

          return (string)$request->getUri();
      } else {
        return $this->get_provider_avatar();
      }
    }

    private function get_provider_avatar() {
      if($this->user_profile->provider_image && $this->user_profile->provider_image !== '') {
        return $this->user_profile->provider_image;
      }

      return $this->get_gravatar();
    }

    private function get_gravatar() {
      $hash = md5(strtolower(trim($this->attributes[$this->gravatarEmail])));
      $client = new Client();
      $uri = 'http://www.gravatar.com/avatar/' . $hash . '?s=300';
      try {
        $res = $client->request('GET', $uri . '?d=404');
        if ($res->getStatusCode() != 200) {
          $uri = 'http://www.gravatar.com/avatar/' . md5(strtolower($this->email)) . '?d=identicon&s=300';
        }
      } catch(Exception $e) {
        $uri = 'http://www.gravatar.com/avatar/' . md5(strtolower($this->email)) . '?d=identicon&s=300';
      }
      

      return $uri;
    }
}