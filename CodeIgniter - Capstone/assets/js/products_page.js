 /*  For pagination highlight    */
        function pageNumHighlight(pageNum){
            $(".pagination > a").css("background-color", "white").css("color", "blue");
            for(var i = 0; i < document.querySelectorAll(".pagination > a").length; i++){
                if(pageNum == $(".pagination > a:nth-child(" + i + ")").text()){
                    $(".pagination > a:nth-child(" + i + ")").css("background-color", "#1975ff").css("color", "white");
                }
            }
        }
        /**********************************************/

        /*  Reset the UI/Display of product categories    */
        function resetCategoryDisplay(){
            $(".product_categories").hide();
            $(".product_category_text_input").attr("readonly", true).css("outline", "none").css("cursor", "default");
            $(".dummy_select_tag").css("border", "0.3px solid rgb(118, 118, 118)");
            $(".bg_category_confirm_delete").hide();
            $(".waiting_icon").css("visibility", "hidden");
        }
        /**********************************************/

        /*  Reset the attributes of checkbox    */
        function resetCheckbox(){
            $(".img_upload_section input[type=checkbox]").attr("disabled", false);
            $(".img_upload_section input[type=checkbox]").siblings("label").css("color", "black");
        }
        /**********************************************/

        /*  Reset the attributes of checkbox    */
        function hideDialogBox(){
            $("dialog.admin_products_add_edit").hide();
            $(".admin_product_delete").hide();
            $(".modal_bg").hide();
        }
        /**********************************************/


        $(document).ready(function(){

            hideDialogBox();

            /*  Pagination at footer    */
            var pageNum = 1;
            pageNumHighlight(pageNum);

            $(document).on("click", ".pagination > a:not(.next_page)", function(){
                pageNum = $(this).text();
                pageNumHighlight(pageNum);
                return false;
            });
            $(document).on("click", ".next_page", function(){
                pageNum++;
                pageNumHighlight(pageNum);
                return false;
            });
            /**********************************************/

            /*  Open add new product dialog box    */
            $(document).on("click", ".btn_add_product", function(){
                $('.form_product_add_edit').attr('action', '/dashboard/products/process_add')
                $(".add_edit_product_header").text("Add a new product");
                $(".input_product_name").val("");
                $(".input_product_desc").val("");
                $(".dummy_select_tag span:first-child").text("");
                $(".input_product_price").val("");
                $(".input_product_qty").val("");
                $(".img_upload_container").html("");
                $(".btn_submit_products_add_edit").val("Add");
                $(".btn_submit_products_add_edit").removeClass("edit_product_submit");
                $(".btn_submit_products_add_edit").addClass("add_product_submit");
            });
            /**********************************************/

            /*  Clicking add button will submit the form using ajax    */
            $(document).on("click", ".add_product_submit", function(){
                $('.form_product_add_edit').submit();
            });
            /********************************************************************/

            /**********************************/
            $(document).on('submit', '.form_product_add_edit', function(){
                var form = $(this);
                $.post(form.attr('action'), form.serialize(), function(data){
                    //$('#main').html(data);
                });
                //return false;
            });
            /*************************************/


            /*  Open delete product dialog box    */
            $(document).on("click", ".product_delete_link", function(){
                var productID = $(this).parent().parent().siblings(".product_id").text();
                var productName = $(this).parent().parent().siblings(".product_id + td").text();
                $(".admin_product_delete .product_id").val(productID);
                $(".delete_product_id").text(productID);
                $(".delete_product_name").text(productName);
                $(".modal_bg_delete_product").show();
                $(".admin_product_delete").show();
                return false
            });

            $(document).on("click", ".admin_product_delete > div > button, .modal_bg_delete_product", function(){
                $(".admin_product_delete").hide();
                $(".modal_bg_delete_product").hide();
            });

            // submit delete form using the general ajax. Not this!
            $(document).on("click", ".admin_product_delete input[type=submit]", function(){
                $(".product_id_" + $(this).siblings().val()).remove();
                $(this).parent().submit(function(){ return false; });
                $(".admin_product_delete").hide();
                $(".modal_bg_delete_product").hide();
            });
            /**********************************************/

             /*  Open edit product dialog box    */
            //  $(document).on("click", ".product_edit_link", function(){
            //     var productID = $(this).parent().parent().siblings(".product_id").text();
            //     var headerStr = "Edit Product - ID " + productID;
            //     var productName = $(this).parent().parent().siblings(".product_id + td").text();
            //     var productDesc = "Product description...Product description...Product description...Product description...Product description...Product description...Product description...";
            //     var productCategory = productName;
            //     var productPrice = 19.99;
            //     var productInventory = $(this).parent().parent().siblings(".product_id + td + td").text();
            //     var productImgSrc = $(this).parent().parent().parent().children("td:first-child").find("img").attr("src");
            //     var productImgAlt = $(this).parent().parent().parent().children("td:first-child").find("img").attr("alt");

            //     var htmlImgStr = "" +
            //         '<li class="img_upload_section">' +
            //             '<figure>' +
            //                 '<img src="' + productImgSrc + '" alt="' + productImgAlt + '" />' +
            //             '</figure>' +
            //             '<p class="img_filename">' + productImgAlt + '</p>' +
            //             '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash btn_img_upload_delete" viewBox="0 0 16 16">' +
            //                 '<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>' +
            //                 '<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>' +
            //             '</svg>' +
            //              '<input type="checkbox" name="main_image" value="filename" />' +
            //             // '<input type="checkbox" name="img_upload_main_id" value="filename" />' +
            //             '<label>main</label>' +
            //         '</li>';

            //     $(".add_edit_product_header").text(headerStr);
            //     $(".input_product_name").val(productName);
            //     $(".input_product_desc").val(productDesc);
            //     $(".dummy_select_tag span:first-child").text(productCategory);
            //     $(".input_product_price").val(productPrice);
            //     $(".input_product_qty").val(productInventory);
            //     $(".img_upload_container").html(htmlImgStr);

            //     $(".products_add_edit_btn .product_id").val(productID);
            //     $(".btn_submit_products_add_edit").val("Update");
            //     $(".btn_submit_products_add_edit").removeClass("add_product_submit");
            //     $(".btn_submit_products_add_edit").addClass("edit_product_submit");
            //     $(".modal_bg").show();
            //     $("dialog.admin_products_add_edit").show();
            //     return false;
            // });
            /**********************************************/

            /*  Clicking add button will submit the form using ajax    */
            // submit form using the general ajax. Not this!
            // $(document).on("click", ".edit_product_submit", function(){
            //     var productIdEdited = ".product_id_" + $(".products_add_edit_btn .product_id").val();
            //     var productName = $(".input_product_name").val();
            //     var productInventory = $(".input_product_qty").val();

            //     var imgUpload = $(".img_upload_section > figure > img");
            //     var imgCheckbox = $(".img_upload_section > input[type=checkbox]");
            //     var prevProductImg = [];
            //     var mainIndexImg = 0;
            //     for(var i = 0; i < imgUpload.length; i++){
            //         prevProductImg[i] = imgUpload[i].currentSrc;
            //         if(imgCheckbox[i].checked){
            //             mainIndexImg = i;
            //         }
            //     }
            //     var productImgSrc = prevProductImg[mainIndexImg];
            //     var productImgAlt = "img";

            //     $(productIdEdited).children(".product_id + td").text(productName);
            //     $(productIdEdited).children(".product_id + td + td").text(productInventory);
            //     $(productIdEdited).children("td:first-child").find("img").attr("src", productImgSrc);
            //     $(productIdEdited).children("td:first-child").find("img").attr("alt", productImgAlt);
            //     $(this).parent().parent().submit(function(){ return false; });
            //     hideDialogBox();
            //     return false;
            // });
            /**********************************************/


            /*  Initializing the content of product categories    */
            var categories = [''];
            $.get('/products/categories/get_categories_name', function(res) {
                res = JSON.parse(res);
                categories = categories.concat(res);
                var categoriesOption = "<form></form>";
                var selectOptions = "";
                for(var i = 0; i < categories.length; i++){
                    if(i>0){
                        var category_name = categories[i][1]
                        var category_id = categories[i][0]
                    }else{
                        var category_name = ' ';
                        var category_id = 0;
                    }
                    categoriesOption += 
                        '<li class="d-flex align-items-center product_category_edit_delete_section arr_' + i + '">' +
    
                            '\n\t<form class="form_product_category_edit" action="" method="post">' +
                            '<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />'+

                                '\n\t\t<input class="product_category_id" type="hidden" name="category_id" value= '+category_id+' />' +
                                '\n\t\t<input class="product_category_text_input" readonly type="text" value="' + category_name + '"/>' +
                            '\n\t</form>' +

                            '\n\t<div class="product_category_btn">' +

                                '\n\t\t<div class="waiting_icon"><img src="https://loading.io/mod/spinner/blocks/sample.png"></div>' +

                                '\n\t\t<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pencil-fill btn_product_category_edit" viewBox="0 0 16 16">' +
                                    '\n\t\t\t<path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>' +
                                '\n\t\t</svg>' +

                                '\n\t\t<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash btn_product_category_delete" viewBox="0 0 16 16">' +
                                    '\n\t\t\t<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>' +
                                    '\n\t\t\t<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>' +
                                '\n\t\t</svg>' +

                            '\n\t</div>' +

                        '\n</li>';
    
                    selectOptions += '<option value="' + categories[i] + '">' + categories[i] + '</option>';
                }
                $(".product_categories").html(categoriesOption);
                resetCategoryDisplay();
            });

            $(document).on('click', '.product_category_edit_delete_section', function(){
                var id = $(this).children().children().attr('value');
                $('#product_category_id').val(id);
            });


            /**********************************************/



            /*  Show the options/categories for the dummy select tag    */
            // $(document).on("click", ".dummy_select_tag", function(){
            //     $(this).css("border", "2px solid black");
            //     $(".product_categories").toggle();
            // });
            /**********************************************/

            /*  Assign the value of selected option to the dummy select tag    */
            $(document).on("click", ".form_product_category_edit", function(){
                if($(this).children(".product_category_text_input").attr("readonly") != null){
                    $(".dummy_select_tag span:first-child").text($(this).children(".product_category_text_input").val());
                    resetCategoryDisplay();
                }
            });
            /**********************************************/

            /*  Edit the value of the specific category    */
            $(document).on("click", ".btn_product_category_edit", function(){
                $(".product_category_text_input").attr("readonly", true).css("outline", "none");
                $(this).parent().siblings("form").children(".product_category_text_input").attr("readonly", false).css("outline", "2.5px solid black").css("cursor", "text");
            });

            // This should be on ajax
            $(document).on("mouseleave keypress", ".product_category_text_input", function(){
                if($(this).attr("readonly") != "readonly"){
                    // display waiting icon before sending
                    $(this).parent().siblings(".product_category_btn").children(".waiting_icon").css("visibility", "visible");
                    // activate ajax and send form.
                    $(this).parent().submit(function(){ return false; });
                    // hide waiting icon after receiving ang changing all data.
                    setTimeout(function(){
                        $(".waiting_icon").css("visibility", "hidden");
                    }, 500);
                }
            });
            /**********************************************/
            
            /*  Show the delete category confirmation box to confirm delete    */
            $(document).on("click", ".btn_product_category_delete", function(){
                resetCategoryDisplay();

                var categoryName = $(this).parent().siblings("form").children(".product_category_text_input").val();
                var categoryID = $(this).parent().siblings("form").children(".product_category_id").val();
                $(".category_name").text(categoryName);
                $(".category_id").val(categoryID);

                $(".bg_category_confirm_delete").show();
            });

            $(document).on("click", ".category_confirm_delete > div > button, .bg_category_confirm_delete", function(){
                $(".bg_category_confirm_delete").hide();
            });

            // submit delete form using the general ajax. Not this!
            $(document).on("click", ".category_confirm_delete input[type=submit]", function(){
                $("." + $(this).siblings().val()).remove();
                $(this).parent().submit(function(){ return false; });
                resetCategoryDisplay();
            });
            /**********************************************/

            /*  Stop propagation of clicks on dummy select tag and the confirm date box. And reset display when click outside of these elements    */
            $(document).on("click", ".select_tag_container, .category_confirm_delete", function(e){
                e.stopPropagation();
            });

            $(document).on("click", "html", function(){
                resetCategoryDisplay();
            });
            /**********************************************/

            /*  DOCU: This function read the uploaded image files.
                This codes used the FileReader from JavaScript.
                This will render the preview of uploaded images.
            */
            function readURL(input) {
                if(!input.files || !input.files[0]){
                    return false;
                }
                else if($(".img_upload_section").length + input.files.length > 7){
                    alert("Only seven (7) images in total are allowed to be upload.");
                    return false;
                }

                var reader = new FileReader();
                var onLoadCounter = 0;
                reader.addEventListener('load', function(e){
                // reader.onload = function (e) {
                    var htmlStr = "" +
                        '<li class="img_upload_section">' +
                            '<figure>' +
                                '<img src="' + e.target.result + '" alt="' + input.files[onLoadCounter].name + '" />' +
                            '</figure>' +
                            '<p class="img_filename">' + input.files[onLoadCounter].name + '</p>' +
                            '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash btn_img_upload_delete" viewBox="0 0 16 16">' +
                                '<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>' +
                                '<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>' +
                            '</svg>' +
                            // '<input type="checkbox" name="is_img_upload_main_id" value="filename" />' +
                            '<input class="main_image" type="checkbox" name="main_image" value='+ onLoadCounter +' />' +
                            '<label>main</label>' +
                        '</li>';
                    
                    onLoadCounter++;
                    $(".img_upload_container").append(htmlStr);
                // }
                });
                reader.readAsDataURL(input.files[0]);

                var counter = 1;
                reader.onloadend = function(e){
                    if(counter < input.files.length){
                        reader.readAsDataURL(input.files[counter]); 
                        counter++;
                    }
                }
            }

            $(document).on("change", "#img_upload", function(){
                readURL(this); // javascript solution
            });

            /********************************************************************/
            

            /*  Disable other checkbox when a checkbox is checked    */
            $(document).on("click", ".img_upload_section input[type=checkbox]", function(){
                if($(".img_upload_section input[type=checkbox]").not(this).attr("disabled")){
                    resetCheckbox();
                }
                else{
                    $(".img_upload_section input[type=checkbox]").not(this).attr("disabled", true);
                    $(".img_upload_section input[type=checkbox]").not(this).siblings("label").css("color", "gray");
                }
            });
            /********************************************************************/

            /*  Remove the uploaded photo and verify if checkbox is checked to reset the checkbox    */
            $(document)
                .on("mouseover", ".img_upload_section",  function(){
                    $(this).children(".btn_img_upload_delete").css("visibility", "visible");
                    $(this).children(".btn_img_upload_delete").css("cursor", "pointer");
                    $(this).css("outline", "2px solid #1975ff");
                })
                .on("mouseleave", ".img_upload_section",  function(){
                    $(this).children(".btn_img_upload_delete").css("visibility", "hidden");
                    $(this).children(".btn_img_upload_delete").css("cursor", "default");
                    $(this).css("outline", "none");
                });
                
            $(document).on("click", ".btn_img_upload_delete", function(){
                if(!$(this).siblings("input[type=checkbox]").attr("disabled")){
                    resetCheckbox();
                }
                $(this).parent().remove();
            });
            /********************************************************************/

            /*  For sorting/arrangement of photo    */
            $(document)
                .on("mouseover", ".img_upload_section figure",  function(){
                    $(this).parent().parent().sortable({
                        start: function(e, ui){
                            ui.placeholder.height(ui.item.height());
                        }
                    });
                    $(this).parent().parent().sortable("enable");
                    $(this).css("cursor", "grab");
                })
                .on("mouseleave", ".img_upload_section figure",  function(){
                    $(this).parent().css("background-color", "white");
                    $(this).parent().parent().sortable("disable");
                })
                .on("mousedown", ".img_upload_section figure",  function(){
                    $(this).css("cursor", "grabbing");
                })
                .on("mouseup", ".img_upload_section figure",  function(){
                    $(this).css("cursor", "grab");
                });
            /********************************************************************/

             /*  Clicking cancel or close will close the dialog box    */
            $(document).on("click", ".btn_cancel_products_add_edit, .btn_close", function(){
                hideDialogBox();
                return false;
            });
            /********************************************************************/

            /*  Clicking preview button will display a new tab of Preview page    */
            $(document).on("click", ".btn_preview_products_add_edit", function(){
                var prevProductName = $("#product_name").val();
                var prevProductDesc = $("#product_desc").val();
                var prevProductPrice = $("#product_price").val();

                var totalOptions = 3;
                var prevProductPriceOption = [];
                for(var i = 0; i < totalOptions; i++){
                    prevProductPriceOption[i] = i + 1 + ' ($' + prevProductPrice * (i + 1) + ')';
                }

                var imgUpload = $(".img_upload_section > figure > img");
                var imgCheckbox = $(".img_upload_section > input[type=checkbox]");
                var prevProductImg = [];
                var mainIndexImg = 0;
                for(var i = 0; i < imgUpload.length; i++){
                    prevProductImg[i] = imgUpload[i].currentSrc;
                    if(imgCheckbox[i].checked){
                        mainIndexImg = i;
                    }
                }

                preview(prevProductName, prevProductDesc, prevProductPriceOption, prevProductImg, mainIndexImg);
            });
            /********************************************************************/

           
        });
 function preview(prevProductName, prevProductDesc, prevProductPriceOption, prevProductImg, mainIndexImg){
            var previewWindowHTML = '' +
                '<!DOCTYPE html>' +
                '<html lang="en">' +
                '<head>' +
                    '<meta charset="UTF-8">' +
                    '<meta http-equiv="X-UA-Compatible" content="IE=edge">' +
                    '<meta name="viewport" content="width=device-width, initial-scale=1.0">' +
                    '<title>(Product Page) '+ prevProductName +' | Lashopda</title>' +
                    
                    `<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>` +
                    `<script src="<?= base_url('assets/js/jquery-ui.js') ?>"></script>` +
                    `<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">`+
                    `<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>`+
                    `<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">`+
                    `<link rel="stylesheet" type="text/css" href="/assets/style/normalize.css" />`+
                    `<link rel="stylesheet" type="text/css" href="/assets/style/style.css" />`+
                    
                '</head>' +
                '<body>' +
                
                    `<nav class="navbar navbar-expand-lg fixed-top" id="nav" data-bs-theme="dark">`+
                    `<div class="container-fluid">`+
                        `<a class="navbar-brand" href="#">Saljuana</a>`+
                        `<div class="collapse navbar-collapse" id="navbarNavAltMarkup">`+
                            `<div class="navbar-nav">`+
                                `<a class="nav-link" href="/dashboard/products">Products</a>`+
                                `<a class="nav-link" href="/dashboard/orders">Order</a>`+
                            `</div>`+
                        `</div>`+
                        `<a class="btn logoff" type="submit">Log-Off</a>`+
                    `</div>`+
                    `</nav>` +

                    '<main>' +
                        '<section class="item_panel d-flex flex-column">' +
                            '<div class="item_details d-flex row">' +
                                '<aside class="img_section col-sm-3">' +
                                    '<img class="main_img" src="' + prevProductImg[mainIndexImg] + '" alt="img"/>' +
                                    '<section>';
            for(var i = 0; i < 4; i++){
                previewWindowHTML += '<img class="sub_img" src="' + prevProductImg[i] + '" alt="img"/>'
            }
            previewWindowHTML += '' +
                                    '</section>' +
                                '</aside>' +
                                '<aside class="d-flex flex-column col-sm-9 prod_desc">' +
                                    '<h2>' + prevProductName + '</h2>' +
                                    `<textarea class="scroll" disabled>${prevProductDesc}</textarea>`+
                                    //'<p>' + prevProductDesc + '</p>' +
                                    '<form action="" method="post">' +
                                        '<input type="hidden" name="product_id" value="product_id"/>' +
                                        `<div class="d-flex row  align-items-end justify-content-end">`+
                                        '<select class="new_order_qty">' +
                                            '<option>' + prevProductPriceOption[0] + '</option>' +
                                            '<option>' + prevProductPriceOption[1] + '</option>' +
                                            '<option>' + prevProductPriceOption[2] + '</option>' +
                                        '</select>' +
                                        '\n'+
                                        `<div class="col-sm-2 ">`+
                                            `<input class="btn btn-lg btn-primary add_to_cart" type="submit" value="Add to Cart">`+
                                        `</div>` +
                                        '<p class="item_added_confirm">Item added to the cart.</p>' +
                                        `</div>`+
                                    '</form>' +
                                '</aside>' +
                            '</div>' +
                        '</section>' +
                    '</main>' +
                '</body>';

            var previewWindow = window.open("", "Preview");
            previewWindow.document.write(previewWindowHTML);
        }

        $(document).on('change keyup click', '#admin_search, delete_product', function(){
            $('#search_form').submit();
        });

        $(document).on('submit', '#search_form, .form_delete_product', function(){
            var form = $(this);
            $.post(form.attr('action'),form.serialize(), function(res){
                console.log(res);
                $('#partial').html(res);
            });
            return false;
        });

        $(document).ready(function(){
            $('.submit_search').click(function(){
                $('#page').val($(this).val());
            })
        })

        $(document).on('click', '.submit_search', function(){
            $('#page').val($(this).val());
            $(".form_admin_products_search").submit();
        })

        // $(document).ready(function(){
        //     $("#edit_modal_button").click(function(){
        //         $("#edit_modal_label").text('Lol');
        //     })
        // })

        function handleSelectTagClick() {
            $(this).css("border", "2px solid black");
            $(".product_categories").toggle();
          }


        $(document).on("click", ".dummy_select_tag", handleSelectTagClick);

        $(".product_add_category").on("input", function() {
        console.log("Input event triggered");
        // Check if the input has a value
        if ($(this).val()) {
            // If it has a value, remove the click event listener from the document
            $(document).off("click", ".dummy_select_tag", handleSelectTagClick);
            console.log('off');
        } else {
            // If it doesn't have a value, add the click event listener back to the document
            $(document).on("click", ".dummy_select_tag", handleSelectTagClick);
            console.log('on');
        }
        });



        $(document).on('click', '.edit_modal_button', function(){
            $('.form_product_add_edit').attr('action', '/dashboard/products/process_edit')
            var link = $(this);
            $.get(link.attr('href'), link.serialize(), function(res){
                res = JSON.parse(res);
                console.log(res);
                var productID = res.id;
                var productName = res.product_name;
                var headerStr = "Edit Product - ID " + productID;
                var productDesc = res.description;
                var productCategory = res.category_name;
                var productInventory = res.inventory_count;
                var productPrice = res.price;
                var categoryID = res.category_id;
                console.log(res.url);

                
                var htmlImgStr = "";
                for(var i=0; i<res.urls.length; i++){
                    
                    var productImgSrc = res.urls[i];
                    var productImgAlt = res.urls[i];
                    htmlImgStr += "" +
                    '<li class="img_upload_section">' +
                        '<figure>' +
                            '<img src="'+ '/' + res.img_url + productImgSrc + '" alt="' + productImgAlt + '" />' +
                        '</figure>' +
                        '<p class="img_filename">' + productImgAlt + '</p>' +
                        '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash btn_img_upload_delete" viewBox="0 0 16 16">' +
                            '<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>' +
                            '<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>' +
                        '</svg>' +
                         '<input type="checkbox" name="main_image" value="filename" />' +
                        // '<input type="checkbox" name="img_upload_main_id" value="filename" />' +
                        '<label>main</label>' +
                    '</li>';
                }
    
                $(".img_upload_container").html(htmlImgStr);
                $(".edit_product_header").text(headerStr);
                $(".edit_product_name").val(productName);
                $(".product_category_id").val(categoryID);
                $(".product_edit_id").val(productID);
                $(".edit_product_desc").val(productDesc);
                $(".dummy_select_tag span:first-child").text(productCategory);
                $(".input_product_price").val(productPrice);
                $(".input_product_qty").val(productInventory);
                $(".img_upload_container").html(htmlImgStr);
    
                //$('#edit_modal').modal('show');
            })
            
            return false;
        })