jQuery(document).ready(function($){
   
   
   var fruit = ["Komkommer", "Peer", "Mandarijn", "Banaan", "Druif", "Watermeloen", "Mango", "Appel", "Sinaasappel"];



   $('button').click(function(){
      // Maak een random geheel getal tussen de 0 en de lengte van het fruit-array
      var index = Math.floor(Math.random() * fruit.length);

      var choise = $("input[type=radio]:checked").val();

      

      if ( choise == "append")
      {
         // Voeg een listItem toe
         $("ol").append("<li>" + fruit[index] + "</li>");
         // Voeg een click-verwijder event toe aan de listItems
         $("ol li:last").click(function(){
            $(this).remove();
         });
      }
      else if (choise == "prepend")
      {
         $("ol").prepend("<li>" + fruit[index] + "</li>");
         $("ol li:first").click(function(){
            $(this).remove();
         });
      }
      else{
         $("h3").text("Kies append of prepend").animate({"height": "55px",
                                                         "border-width": "2px",
                                                         "background-color": "yellow"}, 1000, "easeOutBounce");
      }

      

      $("input[type=radio]").focus(function(){
         $("h3").remove();
      });

      
   });
});