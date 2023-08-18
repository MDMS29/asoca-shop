export const cargarApiMunicipios = async () => {
    let departamentos = [];
    let municipios = [];
    try {
        const data = await fetch('https://www.datos.gov.co/resource/xdk5-pm3f.json');
        const res = await data.json();
        const departamentosSet = new Set(); // Conjunto para almacenar departamentos únicos
        const municipiosSet = new Set();

        res.forEach(item => {
            departamentosSet.add(item.departamento);
            municipiosSet.add({
                departamento: item.departamento,
                municipio: item.municipio
            });
        });

        departamentos = Array.from(departamentosSet); // Convertir el conjunto a un array
        municipios = Array.from(municipiosSet);
        
        return { departamentos, municipios }
    } catch (error) {
        console.log(error);
        return ;
    }
}