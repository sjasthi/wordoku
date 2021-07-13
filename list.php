<?php $page_title = ' Wordoku'; ?>
<?php
$nav_selected = "LIST";
$left_buttons = "NO";
$left_selected = "";

include("./nav.php");

$words = get_quotes();
?>

<style>
    #title {
        text-align: center;
        color: darkgoldenrod;
    }

    thead input {
        width: 100%;
    }

    .thumbnailSize {
        height: 100px;
        width: 100px;
        transition: transform 0.25s ease;
    }

    .thumbnailSize:hover {
        -webkit-transform: scale(3.5);
        transform: scale(3.5);
    }
</style>

<div class="right-content">
    <div class="container-fluid">
       

       

        <form method="POST">
            <h2 id="title">Words List</h2><br>


            <div id="quotesTableView">
                <table class="display" id="quotesTable" style="width:100%">
                    <div class="table responsive">
                        <thead>
                            <tr>
                                <th></th>
                               <th>id</th>

                                <th>word</th>
                                <th>length</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!is_null($words)) {
                                foreach ($words as $quote) {
                                    echo '<tr>
                                        <td><input type ="radio" name ="ident" value =' . $quote["id"] . '></td>
                                      <td>' . $quote["id"] . '</td> 

                                        <td>' . $quote["word"] . '</td> 
                                        <td>' . $quote["length"] . '</td>    
										
                                    </tr>';
                                }
                            } else {
                                echo "0 results";
                            }
                            ?>
            <button type="submit" formaction="createQuote.php">Create</button>
            <button type="submit" formaction="modifyQuote.php">Modify</button>
            <button type="submit" formaction="deleteQuote.php">Delete</button>
			<button type="submit" formaction="wordokuPuzzle.php">Generate</button>
			<br>
			<br>
			 

                        </tbody>
                    </div>
                </table>
        </form>

    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<!--Data Table-->
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

<script type="text/javascript" language="javascript">
    $(document).ready(function() {

        
        var table = $('#quotesTable').DataTable({
            orderCellsTop: true,
            fixedHeader: true,
            retrieve: true
        });

    });
</script>
</body>

</html>