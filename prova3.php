<?php
    //Mirar mes, mirar dia 1, mirar total dies, mirar en que cau ultim dia
    //For de dia 1 a ultim, si es dg tancar tr i si es dl obrir tr
    //For de en que cau ultim dia fins 7, <tr> </tr>
    $mes = getMes();
    $any = getAny();
    $data = strtotime('1'.'-'.$mes.'-'.$any);
    $mesSeg=date("M",strtotime('+1 month',$data));
    $mesAnt=date("M",strtotime('-1 month',$data));
    $anySeg=date("Y",strtotime('+1 year',$data));
    $anyAnt=date("Y",strtotime('-1 year',$data));

    function getMes(){
        if (isset($_GET["mes"]))
        {
            $valor = $_GET["mes"];
            if ($valor=="Jan" || $valor=="Feb" || $valor=="Mar" || $valor=="Apr" || $valor=="May" || $valor=="Jun" || $valor=="Jul" || $valor=="Aug" || $valor=="Sep" || $valor=="Oct" || $valor=="Nov" || $valor=="Dec")  return $valor;
            else return date("M");         
        } else return date("M");
    }
    function getAny(){
        if (isset($_GET["any"]))
        {
            $valor = $_GET["any"];
            if (is_numeric($valor)) return intval($valor);
            else return date("Y");            
        } else return date("Y");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table,td{
            border: 1px solid black;
        }
        table{
            background-color: black;
            padding: 5px;
        }
        td{
            background-color: white;
            padding: 10px;
        }
        .d1{
            float: left;
            width: 50%;
            height: 100%;
            background:black;
        }
        .d2{
            float: right;
            width: 50%;
            height: 100%;
            background:black;
        }
        .s1{
            float: left;
            width: 90px;
        }
        .s2{
            float: right;
            width: 90px;
        }
        .dis{
            background-color: #FEE;
        }
        .diu{
            background-color: #F00;
        }
        .act{
            background-color: #DDF;
        }
    </style>
</head>
<body>
    <form action="calendari.php" method="GET">
        <table class="t1" cellspacing=0 rowspacing=0>
            <tr>
            <td><a href="calendari.php?mes=<?php echo $mesAnt;?>&amp;any=<?php if($mes=="Jan")echo $anyAnt; else echo $any;?>">&lt;&lt;</a></td>
                <td colspan="5">
                    <div class="d1">
                        <select class="s1" name="mes" onchange="document.forms[0].submit()">
                            <?php
                                for ($x = 1; $x <= 12; $x++) {
                                    $m=date("M",strtotime('1-'.$x.'-'.$any));
                                    if($m==$mes){
                                        echo "<option value='$m' selected>".date("M",strtotime('1-'.$x.'-'.$any))."</option>";
                                    }else{
                                        echo "<option value='$m'>".date("M",strtotime('1-'.$x.'-'.$any))."</option>";
                                    }
                                }
                            ?>
                        </select>
                        </div>
                        <div class="d2">
                        <select class="s2" name="any" onchange="document.forms[0].submit()">
                            <?php
                                for ($x = -5; $x <= 5; $x++) {
                                    $a=date("Y",strtotime($x.' year'));
                                    if($a==$any){
                                        echo "<option value='$a' selected>".date("Y",strtotime($x.' year'))."</option>";
                                    }else{
                                        echo "<option value='$a'>".date("Y",strtotime($x.' year'))."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </td>
                <td><a href="calendari.php?mes=<?php echo $mesSeg;?>&amp;any=<?php if($mes=="Dec")echo $anySeg; else echo $any;?>">&gt;&gt;</a></td>
            </tr>
            <tr>
                <td>Dl</td>
                <td>Dm</td>
                <td>Dc</td>
                <td>Dj</td>
                <td>Dv</td>
                <td>Ds</td>
                <td>Dg</td>
            </tr>
            <?php
                $dia=1;
                $mes = getMes();
                $any = getAny();
                $nDiesMes=date('t',strtotime($dia.'-'.$mes.'-'.$any));
                $iWDIni= date('N',strtotime('1-'.$mes.'-'.$any));       //Dia setmana primer dia
                $iWDFi= date('N',strtotime($nDiesMes.'-'.$mes.'-'.$any)); //Dia setmana darrer dia mes

                echo "<tr>";
                for ($x = 2; $x <= $iWDIni; $x++){
                echo "<td>&nbsp;--</td>";
                }
                while ($dia <= $nDiesMes){
                    $wd=date('N',strtotime($dia.'-'.$mes.'-'.$any));
                    if($wd=='1'){
                        echo "<tr>";
                    }       
                    

                    if(date('j-M-Y')==date('j-M-Y',strtotime($dia.'-'.$mes.'-'.$any))){
                        echo "<td class='act'>$dia</td>";
                    }else if($wd!='6' && $wd!='7'){
                        echo "<td>$dia</td>";
                    } else if($wd=='6'){
                        echo "<td class='dis'>$dia</td>";
                    } else{
                        echo "<td class='diu'>$dia</td>";
                    }
                    
                    
                    if($wd=='7'){   
                        echo "</tr>";
                    }

                    $dia++;
                }
                if(date('N',strtotime($dia.'-'.$mes.'-'.$any)!='7')){
                    for ($x = 6; $x >= $iWDFi; $x--){
                        echo "<td>&nbsp;--</td>";
                    }
                    echo "</tr>";
                }
            ?>  
        </table>
    </form>
</body>
</html>
<!--  123 -->