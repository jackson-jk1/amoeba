const fs = require('fs')

function monitorar () {
  const components = fs.readdirSync('./components')
  console.log(`${components.length} arquivos encontrados!`)

  for (let component of components) {
    console.log(component)
  }
}	

setInterval(monitorar, 5000)
