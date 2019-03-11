/**
 * Created by Aleck on 11/12/2018.
 *
 */

import {url} from '../../base_url.js'
let instance = axios.create({
    baseURL : url
});

let Niveaux={
    template:"#niveaux",
    data(){
        return {
            niveaux:[

            ],
            cycles:{},
            mat:[

            ],
            newNiveau:{
                code:'',
                nom : '',
                cycle_id:'',
            },/*newMatiere:{
             intitule:'df',
             couleur : '#8b0000',
             },*/
            updateNiveau:{},
            deleteNiveau:{},
        }
    },
    methods:{

        addNiveau(){
            //console.log(this.newPersonnel);
            instance.post('add_niveau',this.newNiveau).then(res=> {
                $.gritter.add({
                    title:"BRAVO",
                    time:4000,
                    text:"La Matiere  "+this.newNiveau.code+"   été Ajouté avec succes.",
                    class_name:"color success"});

                this.loadDatas();
            }).catch(err=>{

                $.gritter.add({
                    title:"Erreur!!!!",
                    time:4000,
                    text:"La Matiere "+this.newNiveau.code+" n'a pas été Ajouté. Réesayer SVP!",
                    class_name:"color danger"});
            })


        },
        del(){

            instance.get('delete_niveau/'+this.deleteNiveau.id).then(res=>{
                $.gritter.add({
                    title:"Suppresion",
                    time:2000,
                    text:"Le Niveau  "+this.deleteNiveau.nom+" a été supprimer avec Success",
                    class_name:"color success"});
                this.loadDatas()
            }).catch(err=>{
                $.gritter.add({
                    title:"Suppresion",
                    time:2000,
                    text:"Erreur de Supppression du Niveau "+this.deleteNiveau.nom,
                    class_name:"color danger"});
            })
        },

        showDeleteModal(matiere){
            this.deleteNiveau=matiere;
            $('#mod-danger').modal('show')
        },
        showEditorModal(niveau){

            this.updateNiveau=niveau;
            $('#form-bp2').modal('show')


        },

        updateniveau(){
            instance.put('update_niveau/'+this.updateNiveau.id,this.updateNiveau).then(res=> {

                console.log(res.data);
                $.gritter.add({
                    title:"Modification",
                    time:2000,
                    text:"Modification effectué avec Success.",
                    class_name:"color success"});
                this.loadDatas();
            }).catch(err=>{
                $.gritter.add({
                    title:"Modification",
                    time:2000,
                    text:"Echec de la Modification.",
                    class_name:"color danger"});
            })
        },
        loadDatas(){

            instance.get('load_niveau').then(res=>{
                console.log(res.data);
                this.niveaux=res.data.niveau
                this.cycles=res.data.dd



            }).catch(err=>{
                console.log(err.response.data);
            })
        }

    },
    mounted(){
        this.loadDatas();
    }

    ,
    computed:{

    }
}
new Vue(
    {
        el:"#app",
        data:{

        },
        methods: {

        },
        components:{
            Niveaux
        }


    }

)

