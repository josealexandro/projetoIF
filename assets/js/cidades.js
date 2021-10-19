function popular_cidades(estado) {
   let dropdown = document.getElementById('cidade');
   let cidade_edit = document.getElementById('cidade_edit');

   dropdown.length = 0;
   
   if (cidade_edit === null) {
      let defaultOption = document.createElement('option');
      defaultOption.text = 'Selecione uma cidade...';
      defaultOption.setAttribute("value", "");
      defaultOption.setAttribute('hidden', 'hidden');
      dropdown.add(defaultOption);
      dropdown.selectedIndex = 0;
   }

   const url = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados/' + estado + '/municipios?orderBy=nome';

   fetch(url)  
   .then(  
      function(response) {  
         if (response.status !== 200) {  
         console.warn('Looks like there was a problem. Status Code: ' + 
            response.status);  
         return;  
         }

         // Examine the text in the response  
         response.json().then(function(data) {  
            let option;
         
            for (let i = 0; i < data.length; i++) {
               option = document.createElement('option');
               option.text = data[i].nome;
               option.value = data[i].nome;
               if (cidade_edit !== null && option.value === cidade_edit.value) {
                  option.selected = true;
               }
               dropdown.add(option);
            }
         });  
      }  
   )  
   .catch(function(err) {  
      console.error('Fetch Error -', err);  
   });
}