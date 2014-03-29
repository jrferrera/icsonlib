    </br>
    </br>   
    </br>
    </br>
        <div id="footer">
            <div class="text-center"> ICS OnLib 2014. 
                <p class="pull-right" id="linked"><?=anchor('about_us', 'ABOUT US')?></p>
                <div class="pull-right1" id="linked"><?=anchor('faq', 'FAQ')?></div> 
                 <div class="pull-right1" id="linked"><?=anchor('devteam', 'DEVTEAM')?></div> 
            </div>
        </div>

       <!-- Main jumbotron for a primary marketing message or call to action -->
    </body>

    

    <!-- This is for the FAQS-->
    <script>
        $(document).ready(function() {
            // Show or hide the sticky footer button
            $(window).scroll(function() {
                if ($(this).scrollTop() > 200) {
                    $('.go-top').fadeIn(200);
                } else {
                    $('.go-top').fadeOut(200);
                }
            });
            
            // Animate the scroll to top
            $('.go-top').click(function(event) {
                event.preventDefault();
                
                $('html, body').animate({scrollTop: 0}, 300);
            })
        });
    </script>
    
    <script>
        var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
        (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
        g.src='//www.google-analytics.com/ga.js';
        s.parentNode.insertBefore(g,s)}(document,'script'));
    </script>      
</html>