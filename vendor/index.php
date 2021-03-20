<?php
  require __DIR__ . '/vendor/autoload.php';

  $options = array(
    'cluster' => 'ap4',
    'useTLS' => true
  );
  $pusher = new Pusher\Pusher(
    '5e2b608b48481e7f8ad1',
    '7d4e3e568f55ab3a0992',
    '1148311',
    $options
  );

  $data['message'] = 'hello world';
  $pusher->trigger('my-channel', 'my-event', $data);
?>