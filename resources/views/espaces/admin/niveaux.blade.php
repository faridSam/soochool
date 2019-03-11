@extends("default")
@section('css')@endsection

@section('js')
    <template id="niveaux">


        <div class="col-sm-12">

            <div id="form-bp1"  role="dialog" class="modal fade colored-header colored-header-primary">
                <div class="modal-dialog custom-width">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #34a853;">
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
                            <h3 class="modal-title">Ajout Niveau</h3>
                        </div>
                        <div class="modal-body ">
                            <div class="form-group col-md-12">
                                <label>Code Niveau</label>
                                <input type="text"  v-model="newNiveau.code" placeholder="Code Niveau" class="form-control">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Nom Niveau</label>
                                <input type="text" v-model="newNiveau.nom" placeholder="Nom Niveau" class="form-control">
                            </div>


                            <div class="form-group col-md-12">
                                <label >Cycle</label>
                                <div >
                                    <select class="form-control"  v-model="newNiveau.cycle_id">
                                        <option value="">Selectionner le Cycle</option>
                                        <option :value="cycle.id" v-for="cycle in cycles">@{{ cycle.nom }}</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default md-close">Annuler</button>
                            <button type="button" data-dismiss="modal" class="btn btn-primary md-close" style="background-color: #34a853; border-color: #34a853;" @click="addNiveau"><i style="color:white;" class="icon mdi mdi-plus-circle-o"></i> Ajouter</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="form-bp2"  role="dialog" class="modal fade colored-header colored-header-primary">
                <div class="modal-dialog custom-width">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
                            <h3 class="modal-title">Modification Niveau</h3>
                        </div>
                        <div class="modal-body ">
                            <div class="form-group col-md-12">
                                <label>Code Niveau</label>
                                <input type="text"  v-model="updateNiveau.code" placeholder="Code Niveau" class="form-control">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Nom Niveau</label>
                                <input type="text" v-model="updateNiveau.nom" placeholder="Nom Niveau" class="form-control">
                            </div>

                            <div class="form-group col-md-12">
                                <label >Cycle</label>
                                <div >
                                    <select class="form-control"  v-model="updateNiveau.cycle_id">
                                        <option value="">Selectionner le Cycle</option>
                                        <option :value="cycle.id" v-for="cycle in cycles">@{{ cycle.nom }}</option>

                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default md-close">Annuler</button>
                            <button type="button" data-dismiss="modal" class="btn btn-primary md-close" @click="updateniveau" ><i style="color:white;" class="icon mdi mdi-edit"></i> Modifier</button>
                        </div>
                    </div>
                </div>
            </div>


            <div id="mod-danger" tabindex="-1" role="dialog" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <div class="text-danger"><span class="modal-main-icon mdi mdi-close-circle-o"></span></div>
                                <h3>Attension!!!!</h3>
                                <p>L' élément sera définitivement supprimer de la Base de Donnée.</p>
                                <div class="xs-mt-50">
                                    <button type="button" data-dismiss="modal" class="btn btn-space btn-default">Annuler</button>
                                    <button type="button" data-dismiss="modal"   @click="del()"  class="btn btn-space btn-danger"><i style="color:white;" class="icon mdi mdi-delete"></i>  Supprimer</button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer"></div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Niveaux
                    <div class="tools"> <button data-toggle="modal" data-target="#form-bp1" type="button" class="btn btn-space btn-success  "><i style="color:white;" class="icon mdi mdi-plus-circle-o"></i> Ajouter</button><span class="icon mdi mdi-more-vert"></span></div>
                </div>
                <div class="panel-body">
                    <table class="table table-condensed table-hover table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-center">Code</th>
                            <th class="text-center">Nom </th>
                            <th class="text-center">Classes </th>
                            <th class="text-center">Matieres </th>
                            <th class="text-center">Cycle</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(niveau,i) in niveaux">

                            <td class="text-center">@{{ i+1 }}</td>
                            <td class="text-center">@{{ niveau.code }}</td>
                            <td class="text-center">@{{ niveau.nom }}</td>
                            <td class="text-center"><span v-for="classe in niveau.classes">@{{ classe.nom }},</span></td>
                            <td class="text-center"><span v-for="matiere in niveau.matieres">@{{matiere.intitule }},</span></td>
                            <td class="text-center">@{{ niveau.cycle_id}}</td>
                            <td class="text-center">

                                <a class="btn btn-info"  @click="showEditorModal(niveau)" data-toggle="modal"><i style="color:white;" class="icon mdi mdi-edit"></i>  Modifier</a>
                                <a class="btn btn-danger"  @click="showDeleteModal(niveau)"><i style="color:white;" class="icon mdi mdi-delete"></i>  Supprimer</a>
                            </td>

                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </template>
    <script src="{{ asset('js/vues/admin/niveaux.js') }}" type="module"></script>
@endsection

@section('content')

    <Niveaux></Niveaux>


@endsection