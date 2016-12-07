
$(document).ready(function(){

  lightbox.modules.actions.init();
  lightbox.modules.comments.init();
  lightbox.modules.events.init();

});

var  lightbox = {
  modules: {}
};

lightbox.modules.load = (function(){

  return{

    // On stocke toutes les images de la galerie dans un tableau
    storeImages: function(){
      var array_images = [];
      $("#My-lightbox-gallery img").each(function(){
        array_images[array_images.length] = this;
      });
      return array_images;
    },

      // On stocke tous les titres de la galerie dans un tableau
      storeTitles: function(){
        var array_titles = [];
        $("#My-lightbox-gallery .vignette div").each(function(){
          array_titles[array_titles.length] = $(this).html();
        });
        return array_titles;
      }

  }

})();

lightbox.modules.actions = (function(){

  return{

    init: function(){
      $("#My-lightbox-gallery .vignette").on("click", this.open);
    },

    // On ouvre la lightbox
    open: function(){
      lightbox.modules.actions.changeImage($(this).children("img"));
      lightbox.modules.actions.changeTitle($(this).children("div").html());
      $("#lightbox").fadeToggle("slow");
    },

    // On joue le changement d'image selon l'image qu'on cherche à afficher (précédent, suivant)
    changeImageAction: function(parametre){
      var img_src = $("#lightbox img").attr("src");
      var arr_img = lightbox.modules.load.storeImages();
      var arr_tit = lightbox.modules.load.storeTitles();
      var i = 0;
      $.each(arr_img, function(){
        if(img_src === $(this).attr("data-img")){
          lightbox.modules.actions.changeImage(arr_img[i+parametre]);
          lightbox.modules.actions.changeTitle(arr_tit[i+parametre]);
          return false;
        }
        i = i+1;
      });
    },

    // On remplace l'image de la lightbox par celle qui est en paramètre
    changeImage: function(image){
      var src = $(image).attr("data-img");
      $("#lightbox img").attr("src", src);
      console.log($("#lightbox img").width());
    },

    // On remplace le titre de la lightbox par celui qui est en paramètre
    changeTitle: function(title){
      $("#lightbox h1").html(title);
    }

  }

})();

lightbox.modules.events = (function(){

  return{

    init: function(){
      $("#lightbox_close").on("click", this.close);
      $("#lightbox_previous").on("click", this.previous);
      $("#lightbox_next").on("click", this.next);

      // On gère les actions sur les touches précédent et suivant du clavier
      $(document).keydown(function(e){
        switch(e.keyCode){
          case 37:
        		lightbox.modules.events.previous();
        		break;
        	case 39:
        	  lightbox.modules.events.next();
        	  break;
        }
      });
    },

    // On ferme la lightbox
    close: function(){
      $("#lightbox").fadeToggle("slow");
    },

    // On affiche l'image précédente
    previous: function(){
      lightbox.modules.actions.changeImageAction(-1);
    },

    next: function(){
      lightbox.modules.actions.changeImageAction(1);
    }

  }

})();

lightbox.modules.comments = (function(){

  function Comment(date, content, image_title){
    this.date = date;
    this.content = content;
    this.image_title = image_title;
  };

  return{

    init: function(){
      $("#comment_validate").on("click", this.addComment);
    },

    addComment: function(){
      var today = new Date();
      var comment_content = $("#comment_content").val();
      var image = $("#lightbox h1").html();
      var com = new Comment(today, comment_content, image);
      console.log(com.content);
      var container = $("<div>");
      var input = container.append($("<input>").text(com.image_title));
      input.attr("type", "hidden");
      container.append($("<strong>").text(com.date));
      container.append($("<p>").text(com.content));
      $("#all_comments").append(container);
      return false;
    }

  }

})();
