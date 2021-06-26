
            function goNext(page_limit){
                //console.log(current_page);
                next.style.display = 'inline'
                if(current_item >= page_limit){
                    prev.style.display = 'inline';
                }

                current_page += 1;
                pages = Math.ceil(allItems.length/page_limit);
                page_limit = current_item + page_limit

                for (let i=0; i<allItems.length; i++){
                    allItems[i].style.display = 'none'
                }

                for(let a=current_item; a<page_limit;  a++){

                    if(current_item < allItems.length){
                        allItems[a].style.display = 'block'
                        if(allItems.length - current_item == 1){
                        next.style.display = 'none';
                        console.log("reached here")
                    }
                        console.log(current_item)
                        current_item += 1
                    }else{
                        if (current_item < page_limit){
                            current_item = page_limit
                        }
                        next.style.display = 'none';
                    }
                }
            }

            function goBack(page_limit){
                
                next.style.display = 'inline';

                if (current_item < page_limit){
                    prev.style.display = 'none';        
                }

                item_end = current_item-page_limit
                item_start = item_end-page_limit


                for(let b=0; b<allItems.length; b++){
                    allItems[b].style.display = 'none';
                }

                for(let c=item_start; c<item_end; c++){
                    if(c == 0){
                        prev.style.display = 'none'
                    }
                    allItems[c].style.display = 'block';
                    console.log(c)
                    current_item -=1;
                }

            }

/*
<script>
    let allItems = document.querySelectorAll(".post");
    let current_item = 0
    let current_page = 1
    const next = document.querySelector("#next");
    const prev = document.querySelector("#prev");

    if(current_item == 0){
        prev.style.display = 'none';
    }
</script>
<script src = "{{URL_ROOT}}/js/paginator.js"></script>
<script>
    window.onload = function(){
        goNext(4)
    }
    next.onclick = function(){
        goNext(4)
    }
    prev.onclick = function(){
        goBack(4);
    }
</script>
*/