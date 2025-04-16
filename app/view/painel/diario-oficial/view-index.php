<main>
    <section>
        <div class="row mb-3 pr-3" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">     
            <div class="col-md-11" >
                <span class="span-30" style="color: gray"><i class="fa fa-file-text-o"></i>&nbsp;Diário Oficial</span>
            </div>
            <div class="col-md-1 p-0"> 
            </div>
        </div>
    </section>

    <section>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-center align-items-center">
                            <i class="fa fa-chevron-circle-left text-muted" style="font-size: 25px;" onclick="carregarCalendario(-1)"></i>
                            <div style="min-width: 270px; text-align: center;">
                                <span class="span-25 gray" id="mesAno">Calendário</span>
                            </div>
                            <i class="fa fa-chevron-circle-right text-muted" style="font-size: 25px" onclick="carregarCalendario(1)"></i>
                        </div>
                    </div>
                    <div class="card-body position-relative">
                        
                        <!-- Grid do calendário -->
                        <div style="display: flex; flex-wrap: wrap;">
                            <div style=" text-align: center; width: 14.28%; background-color: rgb(250, 74, 74); font-weight: bold; color: #ffffff; border: 1px solid #ffffff">D</div>
                            <div style=" text-align: center; width: 14.28%; background-color: rgba(0,0,0,.5); font-weight: bold; color: #ffffff; border: 1px solid #ffffff">S</div>
                            <div style=" text-align: center; width: 14.28%; background-color: rgba(0,0,0,.5); font-weight: bold; color: #ffffff; border: 1px solid #ffffff">T</div>
                            <div style=" text-align: center; width: 14.28%; background-color: rgba(0,0,0,.5); font-weight: bold; color: #ffffff; border: 1px solid #ffffff">Q</div>
                            <div style=" text-align: center; width: 14.28%; background-color: rgba(0,0,0,.5); font-weight: bold; color: #ffffff; border: 1px solid #ffffff">D</div>
                            <div style=" text-align: center; width: 14.28%; background-color: rgba(0,0,0,.5); font-weight: bold; color: #ffffff; border: 1px solid #ffffff">S</div>
                            <div style=" text-align: center; width: 14.28%; background-color: rgb(250, 74, 74); font-weight: bold; color: #ffffff; border: 1px solid #ffffff">S</div>
                        </div>
                        <div id="calendario" style="display: flex; flex-wrap: wrap;">
                        </div>
                        <div 
                            class="loading" 
                            style="
                            position: absolute; 
                            right: 0; 
                            left: 0; 
                            top: 0;
                            bottom: 0;
                            z-index: 9999;
                            background-color: rgba(0, 0, 0, 0.4);
                            display: none;
                            min-height: 80vh;"
                        >
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
