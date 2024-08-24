<?php

$product_id = $_GET['id'];

$sqlAll = "SELECT * FROM laptop WHERE product_id = $product_id";