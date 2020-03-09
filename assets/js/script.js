(()=>{

    /*script button*/
    function scroll(id){
        document.getElementById(id).addEventListener('click',()=>{
            window.scrollTo({
                top: 0,
                behavior: "smooth"
              });
        })
    }
    window.onscroll = function(){
    if(document.body.scrollTop > 50 || document.documentElement.scrollTop>50){
        document.getElementById('buttonTop').classList.remove('hidden');
    }
    else{
        document.getElementById('buttonTop').classList.add('hidden');
    }
    }
    scroll('buttonTop');


    /*script basket*/
    function animationShop(){
        const TABINDEX = [];
        const buttonClass = document.getElementsByClassName('btn-primary');
        const tabClass = Array.from(buttonClass);

        tabClass.forEach((e,index) => {
            e.id = `btn-${index}`;
            TABINDEX.push(index);
        });

        return TABINDEX;
}
    const tableauShop = animationShop();

    function animationLogo(tableauShopping){
        console.log(basketShop);
        tableauShopping.forEach(tab=>{
            document.getElementById(`btn-${tab}`).addEventListener('click',()=>{
                document.getElementById('basketShop').removeAttribute('class');
                document.getElementById('basketShop').setAttribute('class','fas fa-cart-plus')
            })
        })
    }
    animationLogo(tableauShop);


})()