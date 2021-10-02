<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="styles.css">
<title>Calculator</title>
</head>

<body>
    
    <?php
    
    # If a key has been pressed, store it's value in the variable $pressed
    $pressed='';
    $display='0';
    if (isset($_POST['key_pressed'])) {
        $pressed = $_POST['key_pressed'];
    }
    
    

    #if the hidden store has any characters in it, store them in the variable $stored
    $stored = '';
    if (isset($_POST['stored'])) {
        $stored = $_POST['stored'];
    }
    
    
    #if an operator is pressed before a number, display an error message.
    if (($stored=='') && (($pressed == '+' || $pressed == '-' || $pressed == '*' || $pressed == '/' || $pressed == 'equals'))) {
        $display = "Please enter a number";
        $pressed = '';
    }
    else {
          
     
    #if the key pressed is a number or a decimal point, concatenate it to the variables $display and $displayHidden. Otherwise (it's an operator) and update only $displayHidden. Also check to see if stored is empty. If so, don't display the initial zero.
    if  ((is_numeric ($pressed)) || ($pressed == '.')) {
        if ($stored !== '') {
                $display = $stored . $pressed;
                $displayHidden = $stored . $pressed;
            }
        else if ($stored == '') {
                $display = $pressed;
                $displayHidden = $pressed;
            }
        }
        else {
            $display = $stored;
            $displayHidden = $stored . $pressed;
        }
    
    
        #reset the calculator
        if ($pressed == 'clear') {
            $display = '0';
            $displayHidden = '';
        }
    
       
        #calculate and display the result, then remove the equals from $displayHidden
        if ($pressed == 'equals') {
            $display = eval("return $stored;");
            $displayHidden = $display;
        }        
    }   
    
   ?>
     
    <div class="body-container">
        
        <h1>CAB Accounting Calculator</h1>
        
        <form name="calculator" method="post">
            <div class="calculator-body">
                <div class="container">
                    <input type="text" name="display" class="display" value="<?php echo $display; ?>" />
                    <input type="hidden" name="stored" value="<?php echo $displayHidden; ?>">
                    <button type="submit" name="key_pressed" value="7" class="button">7</button>
                    <button type="submit" name="key_pressed" value="8" class="button">8</button>
                    <button type="submit" name="key_pressed" value="9" class="button">9</button>
                    <button type="submit" name="key_pressed" value="/" class="button operator">/</button>
                    <button type="submit" name="key_pressed" value="4" class="button">4</button>
                    <button type="submit" name="key_pressed" value="5" class="button">5</button>
                    <button type="submit" name="key_pressed" value="6" class="button">6</button>
                    <button type="submit" name="key_pressed" value="*" class="button operator">X</button>
                    <button type="submit" name="key_pressed" value="1" class="button">1</button>
                    <button type="submit" name="key_pressed" value="2" class="button">2</button>
                    <button type="submit" name="key_pressed" value="3" class="button">3</button>
                    <button type="submit" name="key_pressed" value="-" class="button operator">-</button>
                    <button type="submit" name="key_pressed" value="clear" class="button">C</button>
                    <button type="submit" name="key_pressed" value="0" class="button">0</button>
                    <button type="submit" name="key_pressed" value="." class="button">.</button>
                    <button type="submit" name="key_pressed" value="+" class="button operator">+</button>
                    <button type="submit" name="key_pressed" value="equals" class="button" id="equals">=</button>
                </div>        
            </div>
        </form>
        
    </div>
             
</body>
</html>
