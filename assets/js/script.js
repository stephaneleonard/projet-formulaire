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

})()