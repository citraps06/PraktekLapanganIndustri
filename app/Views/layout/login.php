<!DOCTYPE html>
<!-- saved from url=(0059)https://preview.colorlib.com/theme/bootstrap/login-form-18/ -->

<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Login 08</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="<?php echo base_url('') ?>css/css" rel="stylesheet">
      <link rel="shortcut icon" href="<?php echo base_url('admin/dist/img/unp.png') ?>" />
    <link rel="stylesheet" href="<?php echo base_url('login/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('login/css/style.css') ?>">
</head>

<body>

    <?php $this->renderSection('content') ?>

    <script src="<?php echo base_url('login/js/jquery.min.js.download') ?>"></script>
    <script src="<?php echo base_url('login/js/popper.js.download') ?>"></script>
    <script src="<?php echo base_url('login/js/bootstrap.min.js.download') ?>"></script>
    <script src="<?php echo base_url('login/js/main.js.download') ?>"></script>

    <!-- <script>
    mendeleyWebImporter = {
      downloadPdfs(t) {
        return this._call('downloadPdfs', [t]);
      },
      open() {
        return this._call('open', []);
      },
      _call(methodName, methodArgs) {
        const id = Math.random();
        window.postMessage({
          id,
          token: '0.26774376220305474',
          methodName,
          methodArgs
        }, 'https://preview.colorlib.com');
        return new Promise(resolve => {
          const listener = window.addEventListener('message', event => {
            const data = event.data;
            if (typeof data !== 'object' || !('result' in data) || data.id !== id) return;
            window.removeEventListener('message', listener);
            resolve(data.result);
          });
        });
      }
    };
  </script>-->

</body>

</html>
