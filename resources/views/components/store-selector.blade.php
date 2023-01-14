@if(userCanView("stock.available_custom") && auth()->user()->warehousestore_id === NULL)
    <span class="tools pull-right" style="margin-right: 30px">
                                  <div class="form-group">
                                      <label>Switch Store</label>
                                      <select class="form-control form-control-lg change_store col-sm-3" name="global_filter_store">
                                            @foreach(getStores() as $_store)
                                              <option {{ $_store->id == realActiveStore() ?  "selected" : "" }}  {{ $_store->id == request()->get("global_filter_store") ? "selected" : "" }} value="{{ $_store->id }}">{{ $_store->name }}</option>
                                          @endforeach
                                      </select>

                                  </div>
                            </span>
    <br/> <br/>
    <script>
        window.onload = function()
        {
            $(document).ready(function(){
                $('.change_store').on("change",function(){
                    const location = window.location.href.split("?")[0];
                    window.location = location+"?global_filter_store="+$(this).val()
                })
            });
        }
    </script>
@endif
