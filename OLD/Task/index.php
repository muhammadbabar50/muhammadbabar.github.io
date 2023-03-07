<?php
if ($_POST['submit']){
    $artist_name = $_POST[search_artist]; //NF //maroon
    $app_id = "13722599"; //510

    $artist_event = "https://rest.bandsintown.com/artists/$artist_name/events?app_id=$app_id";
    $artist_event_data = file_get_contents($artist_event);
    $artists_events = json_decode($artist_event_data);
    $count = 0;
    foreach ($artists_events as $item) {
        if($item->artist->thumb_url){
            $thumb_url = $item->artist->thumb_url;
        }
        if($item->artist->name){
            $name = $item->artist->name;
        }
        if($item->artist->facebook_page_url){
            $facebook_URL = $item->artist->facebook_page_url;
        }

        $country = $item->venue->country;
        $city = $item->venue->city;
        $venue = $item->venue->name;
        $date = $item->datetime;
        $count++;
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
        <!-- search bar -->
        <div class="container">
            <div class="row mt-5">
                <div class="col-lg-8 mx-auto">

                    <form action="action_page.php" method="POST" id="artistForm">
                        <div class="p-1 rounded rounded-pill shadow-sm mb-4">
                            <div class="input-group">
                                <input type="search" name="search_artist" placeholder="Search Artist" aria-describedby="button-addon1" class="form-control border-0 rounded rounded-pill">
                                <div class="input-group-append">
                                    <button name="submit" value="submit" form="artistForm" id="button-addon1" type="submit" class="btn btn-link text-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- End search bar -->

        <!-- Artist -->
        <?php if($count != 0){ ?>
            <div class="container">
                <div class="col-lg-8 mx-auto">
                    <?php
                        if ($_POST['submit']){ ?>
                            <div class="card row p-2 rounded rounded-pill shadow-sm mb-4">
                                <div class="col-4">
                                    <img class="card-img-top rounded rounded-pill" src="<?php echo $thumb_url;?>" alt="Artist Thumb">
                                </div>
                                <div class="col-8">
                                    <div class="card-body">
                                        <h3 class="card-title"><?php echo $artist_name;?></h3>
                                        <a class="badge badge-light" href="<?php echo $facebook_URL;?>" target="_blank">VISIT Facebook Page</a>
                                    </div>
                                </div>
                            </div>
                    <?php } ?>
                </div>
            </div>
        <?php } else{ ?>
            <div class="container">
                <div class="col-lg-8 mx-auto">
                    <?php
                        if ($_POST['submit']){ ?>
                            <p><?php echo $count; ?> Artist found "<?php echo $artist_name;?>"</p>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        <!-- End Artist -->

        <!-- Result Statement -->
        <div class="container">
            <div class="col-lg-8 mx-auto">
                <?php
                    if ($_POST['submit']){ ?>
                        <p><?php echo $count; ?> Upcoming Events for "<?php echo $artist_name;?>"</p>
                <?php } ?>
            </div>
        </div>
        <!-- End Result Statement -->

        <!-- Events -->
        <?php if($count != 0){ ?>
            <div class="container">
                <div class="col-lg-8 mx-auto">
                    <?php
                        if ($_POST['submit']){ 
                            foreach ($artists_events as $item) { ?>
                                <div class="card mb-5">
                                    <div class="card-header">EVENT DETAILS</div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="card-body">
                                                <h5 class="card-title">Country</h5>
                                                <h6 class="card-text"><?php echo $country ;?></h6>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title">Venue</h5>
                                                <h6 class="card-text"><?php echo $venue ;?></h6>
                                            </div>
                                        </div>
                                    
                                        <div class="col-6">
                                            <div class="card-body">
                                                <h5 class="card-title">City</h5>
                                                <h6 class="card-text"><?php echo $city ;?></h6>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title">Date & time</h5>
                                                <h6 class="card-text"><?php echo $date ;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        } ?>
                </div>
            </div>
        <?php } ?>
        <!-- End Events -->


    </body>
</html>