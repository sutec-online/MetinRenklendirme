<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Renklendirme</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      padding-top: 40px;
    }

    .kirmizi {
      color: red;
    }

    .mavi {
      color: blue;
    }
  </style>

  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">Renklendirme</h3>
        </div>
        <div class="panel-body">
          <?php
          if(isset($_POST['send'])){
            $type = $_POST['type'];
            $sentences = $_POST['sentences'];

            $output = "";
            $unsuzler = ["b", "c", "ç", "d", "f", "g", "ğ", "h", "j", "k", "l", "m", "n", "p", "r", "s", "ş", "t", "v", "y", "z"];
            $unluler = ["a", "e", "ı", "i", "o", "ö", "u", "ü"];

            if($type == 0){
              foreach(preg_split('//u',$sentences, null, PREG_SPLIT_NO_EMPTY) as $character){
                $uc = mb_strtolower($character, "UTF-8");
                if(in_array($uc, $unsuzler)){
                  $output .= "<span class='mavi'>".$character."</span>";
                } elseif(in_array($uc, $unluler)) {
                  $output .= "<span class='kirmizi'>".$character."</span>";
                } else {
                  $output .= $character;
                }
              }
            } elseif($type == 1) {
              foreach(preg_split('//u',$sentences, null, PREG_SPLIT_NO_EMPTY) as $character){
                if(ord($character) % 2 == 0){
                  $output .= "<span class='mavi'>".$character."</span>";
                } else {
                  $output .= "<span class='kirmizi'>".$character."</span>";
                }
              }
            }
            ?>
            <div class="alert alert-warning">
              <p><b>Sonuç:</b> <?php echo $output; ?></p>
            </div>
            <?php
          }
          ?>
          <form action="index.php" method="POST">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">Metni Giriniz</span>
                <textarea class="form-control" name="sentences"><?php if(isset($_POST['sentences'])){ echo $_POST['sentences']; } ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="radio">
                <label>
                  <input type="radio" name="type" value="0" <?php if(!isset($_POST['type'])): ?> checked <?php endif; if(isset($_POST['type']) && $_POST['type'] == "0"): ?> checked <?php endif; ?>> Ünlü harfler kırmızı, ünsüz harfler mavi
                </label>
              </div>
              <div class="radio">
                <label>
                  <input type="radio" name="type" value="1" <?php if(isset($_POST['type']) && $_POST['type'] == "1"): ?> checked <?php endif; ?>> ASCII kodu tek olanlar kırmızı, çift olanlar mavi
                </label>
              </div>
            </div>
            <p class="text-center">
              <button type="submit" name="send" class="btn btn-info btn-block">Renklendir</button>
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
