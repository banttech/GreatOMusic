<div class="inner_table">
    <div>
        <table class="table table-dark">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="width-30">
                        <p class="text-white tbl_heading">Title</p>
                    </th>
                    <th scope="col" class="width-15">
                        <p class="text-white tbl_heading">Genre</p>
                    </th>
                    <th scope="col" class="width-15">
                        <p class="text-white tbl_heading">Tempo</p>
                    </th>
                    <th scope="col" class="width-15">
                        <p class="text-white tbl_heading">Version</p>
                    </th>
                    <th scope="col" class="width-25"> </th>
                </tr>
            </thead>
            <tbody>
            @if(count($musics) > 0)
                @foreach($musics as $music)
                <tr>
                    <td scope="row">
                        <div class="table_img">
                            <img src="{{ asset('frontend-assets/image/1.png')}}" alt="" style="width: 37px;height: 37px;">
                            <div class="table_pra">
                                <p>
                                    {{ substr($music->title, 0, 45) }}{{ strlen($music->title) > 45 ? "..." : "" }}
                                </p>
                                <p class="text-secondary"> 
                                    {{ substr($music->artist, 0, 45) }}{{ strlen($music->artist) > 45 ? "..." : "" }}
                                </p>
                            </div>
                        </div>
                        </th>
                    <td>
                        <p class="td_pra"> {{ $music->genre }}</p>
                    </td>
                    <td>
                        <p class="td_pra"> {{ $music->tempo }}</p>
                    </td>
                    <td>
                        <p class="td_pra"> {{ $music->version }}</p>
                    </td>
                    <td> <a href=""><button class="btn-3"> <img src="{{ asset('frontend-assets/image/carticon.png')}}"
                                    style="width: 16px; height:1ypx;padding-bottom: 2px;" alt="">
                                BUY LICENSE</button></a></td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="5" class="text-center">No tracks found.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>


<div class="d-felx justify-content-center" id="music-list">
    {{ $musics->links() }}
</div>