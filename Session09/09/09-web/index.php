<?php 
    $ua = $_SERVER['HTTP_USER_AGENT'];
    if(strtolower(substr($ua,strpos($ua,"Chrome"),6)) !== "chrome" &&
    strtolower(substr($ua,strpos($ua,"AppleWebKit"),11)) !== "applewebkit" &&
    strtolower(substr($ua,strpos($ua,"Mozilla"),7)) !== "mozilla" &&
    strtolower(substr($ua,strpos($ua,"Safari"),6)) !== "safari" &&
    strtolower(substr($ua,strpos($ua,"Edg"),3)) !== "edg"
    ){
        die(printf("Invalid User Agent"));
    }
    include "./helper/connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programming For Penetration Testing</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
    <nav class="bg-blue-300">
        
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <a href="#">
                    <div class="flex-shrink-0 flex items-center">
                        <img class="hidden lg:block h-8 w-auto" src="./assets/logo.png" alt="Workflow">
                        Bluejack Scrapping
                    </div>
                </a>
            </div>
        </div>
    </nav>

    <main class="form-container" id="uploader-form">
        <div class="space-y-4">
            <div class="block border border-blue-300 rounded">
                <div class="inline-flex p-2">
                    <img src="./assets/prod1.png" alt="" width="150" height="200">
                    <div class="block p-5">
                        <h1 class="text-4xl">Product name here</h1>
                        <pre>$ 15</pre>
                    </div>
                    
                </div>
            </div>

            <?php
                $query = "SELECT * FROM `products`";
                $result = $conn->query($query);
                while($i = $result->fetch_assoc()){
                    if(random_int(0,100) < 10){
                        $rnd = random_bytes(random_int(16,32));
                    ?>
                        <div class="block border border-blue-300 rounded">
                            <div class="inline-flex p-2">
                                <img src="./assets/prod1.png" alt="" width="150" height="200">
                                <div class="block p-5">
                                    <h1 class="text-4xl"><?= $rnd ?> </h1>
                                    <pre>$ <?= random_bytes(random_int(1,6)) ?> </pre>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <div class="block border border-blue-300 rounded">
                    <div class="inline-flex p-2">
                        <img src="./assets/prod1.png" alt="" width="150" height="200">
                        <div class="block p-5">
                            <h1 class="text-4xl"><?= $i['product_name'] ?> </h1>
                            <pre>$ <?= $i['product_price'] ?> </pre>
                        </div>
                    </div>
                </div>
            <?php 
                }
            ?>
            
        </div>

    </main>

</body>
<script src="./script/script.js"></script>
</html>