<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
    <head>
        <title>Home | Felix Lee</title>
        <link type="text/css" rel="stylesheet" href="site.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $("#buttonHideMe").click(function(){
                    $("#pHideMe").hide();
                });
            });
        </script>
    </head>

    <body>
        <div id="main">
            <div id="header">
                <div id="nav-menu">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="blog.html">Blog</a></li>
                        <li><a href="projects.html">Projects</a></li>
                        <li><a href="about.html">About</a></li>
                    </ul>
                </div>
            </div>
            <div id="main-content">

                <!-- Javascript Tests -->

                <p>Button to change background color:</p>

                <button type="button"
                        onclick="changeBgColor()">Click!</button>

                <!--JQuery Tests -->

                <p>Button to hide the following text:</p>
                <p id="pHideMe">Hide me!</p>
                <button id="buttonHideMe">Hide me!</button>

                <!--PHP tests -->

                <p>PHP code to print "Hello World" a number of times</p>

                <?php
                    function printHelloWorld($numOfTimes = 10)
                    {
                        for($i = 0; $i < $numOfTimes; $i++)
                        {
                            echo "<p>Hello World!</p>";
                        }

                        return "Hello World!";
                    }

                    echo printHelloWorld(5);
                ?>

                <p>PHP Code to create a visitor page</p>
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                    <p>Name: <input type="text" name="name"></p>
                    <p>E-Mail: <input type="text" name="email"</p>
                    <input type="submit">
                </form>

                <!-- Actual content -->

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec cursus mollis orci, id aliquam tellus hendrerit vel. Aenean consectetur erat a quam vulputate, a consequat mauris imperdiet. Integer cursus mi vitae pulvinar euismod. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus rutrum, ex et lacinia lobortis, tellus enim sagittis orci, a pharetra est dui vel mauris. Proin ut dignissim augue. Integer ut molestie tellus. Curabitur pellentesque erat sed commodo egestas. Fusce porttitor magna et lacus maximus, in sagittis elit tincidunt. Sed cursus lobortis sem et scelerisque.
                </p>
                <p>Suspendisse potenti. Nunc ultrices pretium velit et feugiat. Fusce a risus tellus. Nam vel mauris nec eros iaculis vestibulum et at nisl. Donec congue, orci ac tempus porttitor, justo neque lobortis tellus, vulputate fringilla neque nibh in dolor. Donec lacus ex, interdum sed libero et, commodo dictum mauris. Aenean dui velit, viverra et malesuada quis, cursus a augue. Integer viverra blandit convallis. Nullam lacinia ex quam, at auctor ex bibendum eget. Duis ultrices porttitor arcu sit amet tempor. Aliquam libero risus, tempus eget ultrices euismod, faucibus sit amet purus. Aenean dolor ligula, vehicula vitae imperdiet id, rutrum non nisl.
                </p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sollicitudin nec eros eu suscipit. Aenean viverra tincidunt lectus et rutrum. Vivamus consequat, augue quis porttitor tempor, dolor augue fermentum purus, nec maximus leo erat in augue. Etiam quam ex, mattis sit amet tincidunt non, cursus vitae dolor. Duis ac placerat nisl. Donec commodo odio sed posuere eleifend.
                </p>
                <p>Fusce velit tortor, auctor at tincidunt vehicula, lobortis ut lorem. Integer dapibus nisi id massa porttitor semper. Cras gravida tortor et est iaculis, id tincidunt massa sodales. Aenean tempor odio ac tincidunt mollis. Nam quis est mattis ipsum tincidunt dignissim. Mauris lorem lorem, gravida et pulvinar et, scelerisque vel sem. Mauris porttitor finibus ligula, eu laoreet diam pellentesque quis. Nunc ultricies ut elit ut elementum. Integer fermentum tempor cursus. Donec placerat urna sit amet dui faucibus, feugiat malesuada justo venenatis. In eu metus id mauris fermentum porttitor. Donec sit amet rutrum felis. Donec condimentum justo eu nisi tincidunt, a ullamcorper arcu placerat. Pellentesque a elit ultricies, fermentum nunc ac, condimentum magna. Sed ante diam, fermentum vel mauris et, vehicula euismod arcu. Praesent vehicula elementum sapien, vel condimentum nisi posuere et.
                </p>
                <p>Sed ut ligula lacus. Mauris venenatis felis in dolor ultricies aliquet. Aliquam sapien turpis, venenatis id vulputate a, porttitor eu velit. Vestibulum gravida est sed quam egestas scelerisque. Aenean in lectus iaculis, fermentum ante sit amet, dapibus tellus. Proin dignissim lacus in fermentum pharetra. Proin nec nunc dapibus, tincidunt ipsum ut, dictum sapien. Proin porttitor magna tortor, vitae ultrices velit ullamcorper sed. Vestibulum tincidunt sem sed luctus rutrum.
                </p>
                <p>Aenean vehicula, ligula et posuere auctor, dui purus dictum eros, sed porttitor quam risus sit amet metus. Sed purus enim, tincidunt vitae dictum ac, aliquam non lectus. Sed ultricies luctus erat molestie porttitor. Nam nisl turpis, feugiat ac elementum sed, feugiat eget elit. Nam vitae pretium lacus, quis auctor elit. Duis hendrerit eu lectus sed ornare. Sed mattis vestibulum felis. Ut ullamcorper enim eget varius scelerisque. Cras eget neque sit amet ante facilisis egestas. Suspendisse gravida ullamcorper fringilla. Nullam facilisis laoreet ex ac condimentum. Pellentesque eu felis non dui elementum tincidunt. Nunc accumsan nisi aliquam cursus viverra. Vivamus malesuada ac dui ac efficitur. Integer dictum gravida orci, sed ultrices metus tincidunt ut. Duis viverra felis nisl, vel tempus mi fringilla non.
                </p>
                <p>Integer vulputate, lorem eu viverra varius, dolor tellus pharetra urna, sit amet molestie enim urna in diam. Donec lorem nisl, fermentum nec neque sit amet, feugiat rutrum nunc. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin nulla lorem, scelerisque at rhoncus vitae, finibus a enim. Nunc eu nisi nisi. Praesent sit amet tempus eros. Aliquam luctus magna tortor, nec aliquet orci malesuada et. Morbi finibus vel orci quis ullamcorper.
                </p>
                <p>Suspendisse eleifend nisi purus, tristique tincidunt mauris elementum eget. Donec ut congue est, sit amet tempor lorem. Sed vehicula ligula eget ligula auctor, et consequat nunc vehicula. Cras elementum nunc congue leo tincidunt, aliquet egestas lorem facilisis. Sed diam augue, porta non condimentum non, scelerisque et tellus. Fusce nec tempus dolor, quis fermentum lectus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla congue risus a leo efficitur blandit. Pellentesque id maximus purus, eget consequat est. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Curabitur convallis velit justo, sit amet tincidunt massa elementum non. Ut ut arcu eu est hendrerit consequat eu at augue. Nunc elementum metus leo, id iaculis ligula pharetra convallis.
                </p>
                <p>Vestibulum ut ultricies turpis. Maecenas dictum, mauris a porttitor tincidunt, odio nisi tempor enim, vitae maximus sem lorem eu lorem. Maecenas pellentesque at eros quis blandit. Proin auctor id diam sit amet pharetra. Morbi sed fermentum quam. Vestibulum aliquam massa magna, sit amet vulputate ligula semper et. Vivamus id enim sit amet lectus vehicula aliquet. Quisque sit amet tellus vel augue iaculis iaculis sit amet sit amet felis. Suspendisse elementum velit quis lectus euismod, sed lobortis urna hendrerit. Donec in fermentum magna. Aliquam facilisis, metus condimentum fermentum suscipit, lorem nulla pulvinar ligula, ut luctus orci mauris ac lectus.
                </p>
                <p>Donec nec erat augue. Suspendisse mattis luctus odio, in vehicula elit dapibus eget. Vestibulum sit amet tristique nisl, in pretium mi. Nulla mauris urna, volutpat bibendum bibendum laoreet, facilisis quis leo. Duis at purus non mi molestie commodo eget ut turpis. Maecenas in ante felis. Donec lacinia lacinia nibh, id sagittis ligula rutrum vitae. Vestibulum sit amet auctor quam, vitae interdum nisi. Sed iaculis ante non lectus tempor varius. Proin vehicula porta eros, quis dapibus ligula vulputate eget. Fusce vitae suscipit tortor, et volutpat urna.
                </p>
            </div>
        </div>
        <div id="footer">
            <p>Copyright &copy Felix Lee 2015</p>
        </div>
        
        <script>
            function changeBgColor()
            {
                document.body.style.backgroundColor = "orange";
            }
        </script>
    </body>
</html>