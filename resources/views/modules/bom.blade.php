<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'almedah_erp_db');

try {
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}

?>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand" style="font-size: 35px;">BOM</h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown li-bom">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        More
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Edit</a></li>
                        <li><a class="dropdown-item" href="#">Delete</a></li>
                    </ul>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit" onclick="loadBOM()">Refresh</button>
                </li>
                <li class="nav-item li-bom">
                    <button class="btn btn-primary" type="submit" onclick="loadNewBOM()">New</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="card my-2">
        <div class="card-header bg-light">
            <div class="row">
                <div class="col-2">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Name">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Item">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body filter">
            <div class="row">
                <div class="float-left">
                    <button class="btn btn-outline-light btn-sm text-muted shadow-sm">
                        Add Filter
                    </button>
                </div>
                <div class=" ml-auto float-right">
                    <span class="text-muted ">Last Modified On</span>
                    <button class="btn btn-outline-light btn-sm text-muted shadow-sm">
                        <i class="fas fa-arrow-down"></i>
                    </button>
                </div>
            </div>
        </div>
        <table class="table table-bom border-bottom">
            <thead class="border-top border-bottom bg-light">
                <tr class="text-muted">
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </td>
                    <td>Name</td>
                    <td>Status</td>
                    <td>Item</td>
                    <td>Is Active</td>
                    <td>Is Default</td>
                    <td>Total Cost</td>
                    <td>ETC</td>
                    <td></td>
                </tr>
            </thead>
            <tbody class="">
                <?php 
                $sql = "SELECT PRODUCT_CODE, IS_ACTIVE, IS_DEFAULT FROM BOM_BILL_OF_MATERIALS";
                if($stmt=$pdo->prepare($sql)) {
                    if($stmt->execute()) {
                        $rows = $stmt->fetchAll();
                        foreach ($rows as $row) {
                           ?>
                           <tr>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input">
                                </div>
                            </td>
                            <td ><a name="BOM-<?=$row['PRODUCT_CODE']?>-002" href='javascript:onclick=openBlueprint();'>BOM-<?=$row["PRODUCT_CODE"]?>-002</a></td>
                            <td>Default</td>
                            <td class="text-black-50"><?=$row["PRODUCT_CODE"]?></td>
                            <td>
                                <?php
                                    if($row["IS_ACTIVE"] == 1) echo "✓"; 
                                ?>    
                            </td>
                            <td >
                                <?php 
                                    if($row["IS_DEFAULT"] == 1) echo "✓";
                                 ?>
                            </td>
                            <td></td>
                            <td class="text-black-50">14 h</td>
                            <td><span class="fas fa-comments"></span>0</td>
                        </tr>
                        <?php 
                    }
                }
            }
            ?>
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-1 text-center">
        <button type="submit" class=""> <span class="fas fa-chevron-left"></span></button>
    </div>
    <div class="col-1 text-center">
        <p>4 of 4</p>
    </div>
    <div class="col-1 text-center">
        <button type="submit" class=""> <span class="fas fa-chevron-right"></span></button>
    </div>
</div>
</div>