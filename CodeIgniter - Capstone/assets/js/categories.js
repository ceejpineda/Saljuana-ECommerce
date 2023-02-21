
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

        $(document).ready(function(){

            /*  Product categories selection    */
            $(document).on("click", ".products_categories > a", function(){
                categoryName = $(this).text().split("(")[0];
                $(".category_name").text(categoryName);
                $(".products > p").text(categoryName);
                pageNumHighlight(pageNum);
                return false;
            });
            /**********************************************/

            /*  Pagination at footer    */
            var pageNum = 1;
            $(".page_number").text(pageNum);
            pageNumHighlight(pageNum);

            $(document).on("click", ".pagination > a:not(.next_page)", function(){
                pageNum = $(this).text();
                $(".page_number").text(pageNum);
                pageNumHighlight(pageNum);
                return false;
            });
            $(document).on("click", ".next_page", function(){
                pageNum++;
                $(".page_number").text(pageNum);
                pageNumHighlight(pageNum);
                return false;
            });
            /**********************************************/

            /*  Pagination at catalog header    */
            $(document).on("click", ".first_page", function(){
                pageNum = 1;
                $(".page_number").text(pageNum);
                pageNumHighlight(pageNum);
                return false;
            });
            $(document).on("click", ".prev_page", function(){
                if(pageNum > 1){
                    pageNum--;
                }
                $(".page_number").text(pageNum);
                pageNumHighlight(pageNum);
                return false;
            });
            /**********************************************/

            /*  For submission of forms    */
            $(document).on("submit", "form", function(){
                pageNumHighlight(pageNum);
                var form = $(this);
                $.post(form.attr('action'),form.serialize(), function(res){
                    $(".category_name").text($(".category_list").val());
                    $('#paginated').html(res);
                });
                return false;
            });
            /**********************************************/

            $(document).on("change keyup", "input", function(){
                $("#search").submit();
            })

            $('.submit_search').click(function(){
                $('#page').val($(this).val());
            })

            $(document).on('click', '.submit_search', function(){
                $('#page').val($(this).val());
                $("#search").submit();
            })
        });
