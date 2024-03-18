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
        if(isset($_GET['parking'])){
            if($obj['parking'] == true){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
    };

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body data-bs-theme="dark">
    <div class="container">
        <?php
            
                echo '
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
                
                ';
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
                echo'
                </tbody>
            </table>
                ';
                    
            
        ?>
    </div>




    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>