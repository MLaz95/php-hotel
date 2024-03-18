<?php
    $hotels = [

        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ],

    ];

    function hotelFilter($obj){

        // if neither filters have been applied then returns the full list
        if(!isset($_GET['parking']) && !isset($_GET['vote']) || !isset($_GET['parking']) && $_GET['vote'] == ''){
            return true;
        }
        // variables to track if hotel has parking and if it meets the required vote
        $hasParking = true;
        $meetsVote = true;
        
        // if parking filter is on it checks property and returns accordingly, otherwise sets variable to true.
        if(isset($_GET['parking'])){
            if($obj['parking'] == true){
                $hasParking = true;
            }else{
                $hasParking = false;
            }
        }
        
        // if vote filter hasn't been set then sets variable to true, otherwise it compares the input with obj property
        if($_GET['vote'] == ''){
            $meetsVote = true;
        }elseif($obj['vote'] >= $_GET['vote']){
            $meetsVote = true;
        }else{
            $meetsVote = false;
        }
        
        // if both parameters are true, then returns true
        if($hasParking && $meetsVote){
            return true;
        }else{
            return false;
        }

    };

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotels</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body data-bs-theme="dark">

    <div class="container">
        <h1 class="text-center my-5">Hotels</h1>
        <h3>Filters</h3>

        <form action="index.php" class="mb-3 d-flex align-items-center gap-3">
            <div class="">
                <input type="checkbox" class="form-check-input" id="parking" name="parking" value="true">
                <label class="form-check-label" for="parking">Parking</label>
            </div>
            <div class="col-2 d-flex gap-1 align-items-center">
                <input type="number" class="form-control" id="vote" name="vote">
                <label for="vote" class="text-nowrap">Minimum Vote</label>
            </div>
            <button type="submit" class="btn btn-sm btn-primary col-1">Submit</button>
        </form>

        <table class="table table-bordered border-primary">
            <thead>
                <tr>
                    <th scope="col">Hotel</th>
                    <th scope="col">Description</th>
                    <th scope="col">Parking</th>
                    <th scope="col">Vote</th>
                    <th scope="col">Distance to City Center</th>
                </tr>
            </thead>
            <tbody class="table-group-divider border-primary">
                <?php
                // makes a row for each hotel in the list
                foreach(array_filter($hotels, 'hotelFilter') as $currentHotel){
                    echo "
                        <tr>
                            ";
                            // adds a cell in the row for each property of an hotel
                            foreach($currentHotel as $key => $value){
                                echo '<td>';
                                    if($key == 'parking' && $value == true){
                                        echo 'yes';
                                    }elseif($key == 'parking' && $value == false){
                                        echo 'no';
                                    }else{
                                        echo $value;
                                    }
                                echo '</td>';
                            }
                            echo "
                        </tr>
                    ";
                }
                ?>
            </tbody>
        </table>

    </div>
    

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>