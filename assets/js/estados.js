let dropdown = document.getElementById('estado');
let estado_edit = document.getElementById('estado_edit');

dropdown.length = 0;

if (estado_edit === null) {
   let defaultOption = document.createElement('option');
   defaultOption.text = 'Selecione um estado...';
   defaultOption.setAttribute("value", "");
   defaultOption.setAttribute('hidden', 'hidden');
   dropdown.add(defaultOption);
   dropdown.selectedIndex = 0;
}

const url = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados?orderBy=nome';

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
            option.text = data[i].sigla;
            option.value = data[i].sigla;
            if (estado_edit !== null && option.value === estado_edit.value) {
               option.selected = true;
            }
            dropdown.add(option);
         }
         popular_cidades(estado_edit.value);
      });
   }
)  
.catch(function(err) {  
   console.error('Fetch Error -', err);  
});