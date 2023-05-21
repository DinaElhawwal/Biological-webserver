<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="style.css">
</head>

<body>

  <div id='nav'>
            <a href="/index.php" style='font-weight: bold; font-size: 24px;'>Home</a>
            <a href="/insert.html">Insert</a>
            <a href="/delete.html">Delete</a>
            <a href="/update.html">Update</a>
            <div id='profile'>
            <a href="/signup.php">Sign Up</a>
            <a href="/signin.php">Sign In</a>
            </div>
  </div>

  <form method="post">
    <fieldset>
    <legend>Please Select your Genome by selecting its ID </legend>
    <input type="number" name="GeneID"><br>
    <input type="submit" name="Complement" class="button" value="Complement" />
    <input type="submit" name="GC" class="button" value="GC" />
    <input type="submit" name="Transcript" class="button" value="Transcript" />
    <input type="submit" name="Translate" class="button" value="Translate" />
    </fieldset>
  

  </form>


  <?php
  $servername = "localhost";
  $username = "root";
  $password = "usbw";
  $dbname = "genomedb";
  $conn = new mysqli($servername, $username, $password, $dbname);
  $sql = "SELECT Genome_id,Gname FROM genome";
  $result = $conn->query($sql);
  $text = '';
  if ($result->num_rows > 0) {
    // output data of each row
    echo "<table><tr><th>ID</th><th>Name</th></tr>";
    while ($row = $result->fetch_assoc()) {
      echo "<tr> <td>  " . $row["Genome_id"] . " </td> <td>  " . $row["Gname"] . " </td> </tr> <br>";
    }
    echo "</table>";
  } else {
    echo "0 results";
  }
  if (array_key_exists('Complement', $_POST)) {
    Complement($conn);
  }
  if (array_key_exists('GC', $_POST)) {
    GCcontent($conn);
  }
  if (array_key_exists('Transcript', $_POST)) {
    Transcript($conn);
  }
  if (array_key_exists('Translate', $_POST)) {
    Translate($conn);
  }

  function Select($conn)
  {
    $GeneID = $_POST['GeneID'];
    $ref = "SELECT Genome FROM genome WHERE Genome_id= $GeneID";
    $res = $conn->query($ref);
    $row = $res->fetch_assoc();
    $text = $row['Genome'];
    return $text;
  }
  function GCcontent($conn)
  {
    $text = Select($conn);
    if ($text === '') {
      echo '<p>Please Select A Genome</p> ';

    } else {
      $counter = 0;

      for ($i = 0; $i < strlen($text); $i++) {
        if ($text[$i] === 'G' || $text[$i] === 'C') {
          $counter += 1;

        }
      }
      $percentage = $counter / strlen($text) * 100;
      echo "<p>".$percentage." %</p>";
    }

  }

  function Complement($conn)
  {
    $text = Select($conn);
    if ($text === '') {
      echo '<p>Please Select A Genome</p> ';

    } else {
      $textC = '';
      for ($i = 0; $i < strlen($text); $i++) {
        if ($text[$i] === 'G') {
          $textC .= 'C';
        } elseif ($text[$i] === 'C') {
          $textC .= 'G';
        } elseif ($text[$i] === 'A') {
          $textC .= 'T';
        } elseif ($text[$i] === 'T') {
          $textC .= 'A';
        }

      }
      echo "<p>".$textC."</p>";

    }

  }
  function Transcript($conn)
  {
    $text = Select($conn);
    if ($text === '') {
      echo '<p>Please Select A Genome</p> ';

    } else {
      $textC = '';
      for ($i = 0; $i < strlen($text); $i++) {
        if ($text[$i] === 'G') {
          $textC .= 'G';
        } elseif ($text[$i] === 'C') {
          $textC .= 'C';
        } elseif ($text[$i] === 'A') {
          $textC .= 'A';
        } elseif ($text[$i] === 'T') {
          $textC .= 'U';
        }

      }
      echo "<p>".$textC."</p>";

    }

  }
  function Translate($conn)
  {
    $codonTable = array(
    
      'TTT' => 'F',
      'TTC' => 'F',
      'TTA' => 'L',
      'TTG' => 'L',
      'CTT' => 'L',
      'CTC' => 'L',
      'CTA' => 'L',
      'CTG' => 'L',
      'ATT' => 'I',
      'ATC' => 'I',
      'ATA' => 'I',
      'ATG' => 'M',
      'GTT' => 'V',
      'GTC' => 'V',
      'GTA' => 'V',
      'GTG' => 'V',
      'TCT' => 'S',
      'TCC' => 'S',
      'TCA' => 'S',
      'TCG' => 'S',
      'AGT' => 'S',
      'AGC' => 'S',
      'CCT' => 'P',
      'CCC' => 'P',
      'CCA' => 'P',
      'CCG' => 'P',
      'ACT' => 'T',
      'ACC' => 'T',
      'ACA' => 'T',
      'ACG' => 'T',
      'GCT' => 'A',
      'GCC' => 'A',
      'GCA' => 'A',
      'GCG' => 'A',
      'TAT' => 'Y',
      'TAC' => 'Y',
      'TAA' => '*',
      'TAG' => '*',
      'TGA' => '*',
      'CAT' => 'H',
      'CAC' => 'H',
      'CAA' => 'Q',
      'CAG' => 'Q',
      'AAT' => 'N',
      'AAC' => 'N',
      'AAA' => 'K',
      'AAG' => 'K',
      'GAT' => 'D',
      'GAC' => 'D',
      'GAA' => 'E',
      'GAG' => 'E',
      'TGT' => 'C',
      'TGC' => 'C',
      'TGG' => 'W',
      'CGT' => 'R',
      'CGC' => 'R',
      'CGA' => 'R',
      'CGG' => 'R',
      'AGA' => 'R',
      'AGG' => 'R',
      'GGT' => 'G',
      'GGC' => 'G',
      'GGA' => 'G',
      'GGG' => 'G'
      
    );
    $text = Select($conn);
    $Ttext='';
    $codon='';
    $codonTableObj = (object) $codonTable;
    
    if(strlen($text)%3!=0){
      $text=substr($text,0,strlen($text)-(strlen($text)%3));
    }
    
    if ($text === '') {
      echo '<p>Please Select A Genome</p> ';
    }
    else{
      $flag=false;
      for ($i = 0; $i < strlen($text); $i+=3){
        $codon=substr($text,$i,3);
      
        if($codon==='ATG'){
          $flag=true;
      
        }
        if($codon==='TAA'|| $codon==='TGA' || $codon==='TAG'){
          $flag=false;
          $Ttext.=$codonTable[$codon];
          break;
        }
        if($flag){
          if (isset($codonTable[$codon])) {
            $Ttext.=$codonTable[$codon];
        }
          
        }

      }
      
      echo "<p>".$Ttext."</p>";
    }
      
    
  }

  $conn->close();

  ?>

</body>

</html>