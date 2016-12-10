
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
      $("#lightbox").fadeToggle("slow");
      lightbox.modules.actions.changeImage($(this).children("img"));
      lightbox.modules.actions.changeTitle($(this).children("div").html());
      lightbox.modules.comments.displayCommentsByImage();
    },

    // On joue le changement d'image selon l'image qu'on cherche à afficher (précédent, suivant)
    changeImageAction: function(parametre){
      var img_src = $("#lightbox img").attr("src");
      var arr_img = lightbox.modules.load.storeImages();
      var arr_tit = lightbox.modules.load.storeTitles();
      var i = 0;

      $.each(arr_img, function(){
        if(img_src === $(this).attr("data-img")){
          if(i == 0 && parametre == -1){
            lightbox.modules.actions.changeImage(arr_img[arr_img.length - 1]);
            lightbox.modules.actions.changeTitle(arr_tit[arr_tit.length - 1]);
            lightbox.modules.comments.displayCommentsByImage();
            return false;
          }
          if(i == (arr_img.length - 1) && parametre == 1){
            lightbox.modules.actions.changeImage(arr_img[0]);
            lightbox.modules.actions.changeTitle(arr_tit[0]);
            lightbox.modules.comments.displayCommentsByImage();
            return false;
          }
          lightbox.modules.actions.changeImage(arr_img[i+parametre]);
          lightbox.modules.actions.changeTitle(arr_tit[i+parametre]);
          lightbox.modules.comments.displayCommentsByImage();
          return false;
        }
        i = i+1;
      });
    },

    // On remplace l'image de la lightbox par celle qui est en paramètre
    changeImage: function(image){
      var src = $(image).attr("data-img");
      $("#lightbox img").attr("src", src);

      // On adapte la taille de l'image en fonction de la taille de la fenêtre
      $("#lightbox img").removeClass("img_widht").removeClass("img_height");
      var img_size = $("#lightbox img").width() / $("#lightbox img").height();
      var screen_size = $(window).width() / $(window).height();

      if(screen_size >= img_size){
        $("#lightbox img").addClass("img_height");
      }else if(screen_size < img_size){
        $("#lightbox img").addClass("img_widht");
      }
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
      $("#lightbox_comment").on("click", this.openComments);
      $("#lightbox_full_screen").on("click", this.fullScreen);

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
    },

    openComments: function(){
      $("#comments").slideToggle();
    },

    fullScreen: function(){
      $(document).toggleFullScreen();
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

    // On ajoute un commentaire
    addComment: function(){
      var today = new Date();
      var comment_content = $("#comment_content").val();
      var image = $("#lightbox h1").html();
      var com = JSON.stringify(new Comment(today, comment_content, image));

      if(localStorage.getItem("list_comments") != ""){
        com = localStorage.getItem("list_comments") + "," + com;
      }
      localStorage.setItem("list_comments", com);
      lightbox.modules.comments.displayCommentsByImage();
      $("#comment_content").val("");
      return false;
    },

    // On affiche tous les commentaires d'une image
    displayCommentsByImage: function(){

      if(!localStorage.getItem("list_comments")){
        localStorage.setItem("list_comments", "");
      }

      var list_comments = $.parseJSON("[" + localStorage.getItem("list_comments") + "]");

      $("#all_comments").html("");

      for(var i = 0; i< list_comments.length; i++){
        if(list_comments[i].image_title === $("#lightbox h1").text()){
          var container = $("<div>");
          container.append($("<h3>").text(list_comments[i].image_title));
          container.append($("<strong>").text(list_comments[i].date));
          container.append($("<p>").text(list_comments[i].content));
          container.append($("<button>").text("modifier").click(lightbox.modules.comments.modifyComment));
          $("#all_comments").append(container);
        }
      }

    },

    // On modifie un commentaire
    modifyComment: function(){
      var title_image_text_to_modify = $(this).parent().children("h3").text();
      var text_to_modify = $(this).parent().children("p").text();
      var date_text_to_modify = $(this).parent().children("strong").text();
      $("#comment_content").val(text_to_modify);

      var list_comments = $.parseJSON("[" + localStorage.getItem("list_comments") + "]");

      for(var i = 0; i< list_comments.length; i++){
        if(
          list_comments[i].image_title === title_image_text_to_modify &&
          list_comments[i].content === text_to_modify &&
          list_comments[i].date === date_text_to_modify
        ){
          list_comments.splice(i, 1);
        }
      }

      localStorage.setItem("list_comments", JSON.stringify(list_comments));

    }

  }

})();
