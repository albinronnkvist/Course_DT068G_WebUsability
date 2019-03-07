    </div><!-- End of #container -->
    <button onclick="topFunction()" id="myBtn" title="Tillbaka till toppen"><i class="fas fa-angle-up"></i></button>
    <footer>
        <p>
            <!-- Copyright logo -->
            <i class="far fa-copyright"></i> 

            <!-- Print current year -->
            <script>
                var d = new Date()
                document.write(d.getFullYear())
            </script> 
            
            <!-- Sitename -->
            Östhammars kommun
        </p>
    </footer>

    <!-- Scripts -->
    <script src="js/toggle.js"></script>
    <script src="js/sidemenu.js"></script> 
    <script src="js/top.js"></script>
</body>

</html>
<?php
ob_end_flush();
?>