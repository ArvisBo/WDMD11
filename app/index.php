<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WMDMD11</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <?php 
        $list_data = [
            'list_name' => ( !empty($_POST['list_name']) ? $_POST['list_name'] : "" ), 
            'list_count' => ( !empty($_POST['list_count']) ? $_POST['list_count'] : "")
        ];
        $votes = ( !empty($_POST['votes']) ? $_POST['votes'] : []);
        /* Funkcija, kas sakārto datus alfabētiskā secībā*/
        function compareBySurname ($a, $b) {
            return strcmp($a["person_surname"], $b["person_surname"]);
        };
        usort($votes, 'compareBySurname');   
    ?>
    <div>
        <!-- Pirmā forma -->
        <form action="./index.php" method="post">
            <label for="list_name">Saraksta nosaukums</label> <br>
            <input type="text" id="list_name" name="list_name"> <br>
            <label for="list_count">Dalībnieku skaits</label> <br>
            <input type="number" id="list_count" name="list_count" min="1"><br>
            <input type="submit" value="Iesniegt">
        </form>
    </div>

    <br>
    <div>
        <!-- Otrā forma -->
        <?php if (!empty($_POST['list_name']) ) { ?>
        <h1> <?php echo $list_data['list_name']; ?> </h1> <br>
        <form action="./index.php" method="post">
        <?php 
                for($i = 0; $i < $list_data['list_count']; $i++) { ?>
                    <label for="name">Vārds: </label>
                    <input type="text" id="name" name="votes[<?=$i?>][person_name]" >
                    <label for="surname">Uzvārds: </label>
                    <input type="text" id="surname" name="votes[<?=$i?>][person_surname]">
                    <input type="radio" id="par" name="votes[<?=$i?>][person_vot]" value="Par">
                    <Label for="par"> Par </Label>
                    <input type="radio" id="pret" name="votes[<?=$i?>][person_vot]" value="Pret">
                    <Label for="pret"> Pret </Label>
                    <input type="radio" id="atturos" name="votes[<?=$i?>][person_vot]" value="Atturos">
                    <Label for="atturos"> Atturos </Label> 
                    <br>
            <?php } ?>
            <br>
            <input type="submit" value="Iesniegt">
        </form>
        <?php } ?>
    </div>
    <!-- Izvada ievadītās vērtības -->
    <div>
    <?php
        echo '<pre>';
        var_dump($votes);
        echo '</pre>';   
        ?>
    </div>
    <div>
        <!-- Tabula -->
         <table>
            <tr>
                <th>Nr.p.k</th>
                <th>Vārds</th>
                <th>Uzvārds</th>
                <th>Balsojums</th>
            </tr>
            <?php
                $count=0;    
                foreach($votes as $vote => $value) { 
                $count++ ?>
                <tr>
                    <td><?= $count ?></td>
                    <td><?= ($value['person_name']) ?></td>
                    <td><?= ($value['person_surname']) ?></td>
                    <td><?= ($value['person_vot']) ?></td>
                </tr>
            <?php }; ?>
         </table>               
    </div>
</body>
</html>