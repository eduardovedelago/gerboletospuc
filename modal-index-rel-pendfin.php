<div class="modal fade" id="modalRelPendFin" name="modalRelPendFin" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content backgroundHome">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h3 class="modal-title txt-color-blue">Relatório Financeiro</h3>
            </div>
            <div class="tab-pane fade active in padding-10 no-padding-bottom" id="s1">

                <form class="nsubmit" id="frmModalRelFin" name="frmModalRelFin" method="get" action="/form-rel-pendfin.php">
                    <fieldset>
                        <label class="col-sm-3 text-align-left txt-color-orange"> Tipo do Mvto</label>
                        <br>
                        <div class="col-sm-12 center-modal-status">
                            <label for="tipo-1" class="btn-radio">
                                <input type="radio" id="tipo-1" name="radio-grp-tipo" value="1" checked>
                                <svg width="20px" height="20px" viewBox="0 0 20 20">
                                    <circle cx="10" cy="10" r="9"></circle>
                                    <path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z"
                                          class="inner"></path>
                                    <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z"
                                          class="outer"></path>
                                </svg>
                                <span class="txt-color-white">Boletos</span>
                            </label>
                            <!-- <label for="tipo-4" class="btn-radio">
                                <input type="radio" id="tipo-4" name="radio-grp-tipo" value="2">
                                <svg width="20px" height="20px" viewBox="0 0 20 20">
                                    <circle cx="10" cy="10" r="9"></circle>
                                    <path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z"
                                          class="inner"></path>
                                    <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z"
                                          class="outer"></path>
                                </svg>
                                <span class="txt-color-white">Faturas</span>
                            </label>
                            <label for="tipo-2" class="btn-radio">
                                <input type="radio" id="tipo-2" name="radio-grp-tipo" value="3">
                                <svg width="20px" height="20px" viewBox="0 0 20 20">
                                    <circle cx="10" cy="10" r="9"></circle>
                                    <path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z"
                                          class="inner"></path>
                                    <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z"
                                          class="outer"></path>
                                </svg>
                                <span class="txt-color-white">Duplicatas</span>
                            </label>
                            <label for="tipo-3" class="btn-radio">
                                <input type="radio" id="tipo-3" name="radio-grp-tipo" value="4">
                                <svg width="20px" height="20px" viewBox="0 0 20 20">
                                    <circle cx="10" cy="10" r="9"></circle>
                                    <path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z"
                                          class="inner"></path>
                                    <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z"
                                          class="outer"></path>
                                </svg>
                                <span class="txt-color-white">Cheques</span>
                            </label> -->
                        </div>
                    </fieldset>

                    <fieldset>
                        <label class="col-sm-3 text-align-left txt-color-orange"> Status</label>
                        <br>
                        <div class=" col-sm-12 center-modal-status">
                            <label for="rdo-1" class="btn-radio">
                                <input type="radio" id="rdo-1" name="radio-grp-status" value="" checked>
                                <svg width="20px" height="20px" viewBox="0 0 20 20">
                                    <circle cx="10" cy="10" r="9"></circle>
                                    <path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z"
                                          class="inner"></path>
                                    <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z"
                                          class="outer"></path>
                                </svg>
                                <span class="txt-color-white">Todas</span>
                            </label>
                            <label for="rdo-2" class="btn-radio">
                                <input type="radio" id="rdo-2" name="radio-grp-status" value="B">
                                <svg width="20px" height="20px" viewBox="0 0 20 20">
                                    <circle cx="10" cy="10" r="9"></circle>
                                    <path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z"
                                          class="inner"></path>
                                    <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z"
                                          class="outer"></path>
                                </svg>
                                <span class="txt-color-white">Baixadas</span>
                            </label>
                            <label for="rdo-3" class="btn-radio">
                                <input type="radio" id="rdo-3" name="radio-grp-status" value="P">
                                <svg width="20px" height="20px" viewBox="0 0 20 20">
                                    <circle cx="10" cy="10" r="9"></circle>
                                    <path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z"
                                          class="inner"></path>
                                    <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z"
                                          class="outer"></path>
                                </svg>
                                <span class="txt-color-white">Pendentes</span>
                            </label>
                            <label for="rdo-4" class="btn-radio">
                                <input type="radio" id="rdo-4" name="radio-grp-status" value="C">
                                <svg width="20px" height="20px" viewBox="0 0 20 20">
                                    <circle cx="10" cy="10" r="9"></circle>
                                    <path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z"
                                          class="inner"></path>
                                    <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z"
                                          class="outer"></path>
                                </svg>
                                <span class="txt-color-white">Canceladas</span>
                            </label>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="margin-top-10">
                            <label class="col-sm-3 text-align-left txt-color-orange">Data de Mvto</label>
                            <div class="col-sm-3">
                                <div class="flex">
                                    <input class="inputsPF inputsPFInvertBorder"
                                           id="ed_datamvto_i" name="ed_datamvto_i"
                                           type="date"/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="flex">
                                    <input class="inputsPF"
                                           id="ed_datamvto_f" name="ed_datamvto_f"
                                           type="date"/>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>

                        <div class=" margin-top-10">
                            <label class="col-sm-3 text-align-left txt-color-orange">Data de Vcto</label>
                            <div class="col-sm-3">
                                <div class="flex">
                                    <input class="inputsPF inputsPFInvertBorder"
                                           id="ed_datavcto_i" name="ed_datavcto_i"
                                           type="date"/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="flex">
                                    <input class="inputsPF"
                                           id="ed_datavcto_f" name="ed_datavcto_f"
                                           type="date"/>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>

                        <div class="margin-top-10">
                            <label class="col-sm-3 text-align-left txt-color-orange">Data de Baixa</label>
                            <div class="col-sm-3">
                                <div class="flex">
                                    <input class="inputsPF inputsPFInvertBorder"
                                           id="ed_databx_i" name="ed_databx_i"
                                           type="date"/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="flex">
                                    <input class="inputsPF"
                                           id="ed_databx_f" name="ed_databx_f"
                                           type="date"/>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <div class="row margin-top-10">
                        <div class="modal-footer">
                            <button type="submit"
                                    for="frmModalRelFin"
                                    name="btnsubmitrelpendfin"
                                    id="btnsubmitrelpendfin"
                                    class="nsubmit btn-form-modal btn btn-success"
                            ><i class="fa fa-table"></i>
                                Confirmar
                            </button>
                            <button type="button" class="btn-form-modal btn btn-danger"
                                    data-dismiss="modal"><i class="fa fa-close"></i> Cancelar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.modal - content-->
</div><!-- /.modal - dialog-->
</div><!-- /.modal-->
