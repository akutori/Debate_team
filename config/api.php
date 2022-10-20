<?php
//呼び出す場合は config('api.perspectiveAPI.public_key'); とすると呼べる
return [
  'perspectiveAPI' => ['public_key'=>env('PERSPECTIVE_API_PUBLIC_KEY')]
];
