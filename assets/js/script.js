// (()=>{
//    /*script for the footer*/
//    function takeInputValue(name){
//        return document.getElementById(name).value;
//    }
//    function messageError(name){
//        document.getElementById(name).setAttribute('placeholder',`${name} is required`);
//    }
  
//    document.getElementById('run').addEventListener('click',()=>{
//     let firstname = takeInputValue('firstname');
//     let lastname = takeInputValue('lastname');
//     let email = takeInputValue('email');
//     let country = takeInputValue('country');
//     const TABLEFORM = [firstname,lastname,email,country];
//     console.table(TABLEFORM);
//     TABLEFORM.forEach(e=>{
//         console.log(e)
//         if(!e){
//             messageError(e);
//         }
//     })
//    })


// })()