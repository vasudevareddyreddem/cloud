<script src=" https://code.jquery.com/jquery-1.12.4.js" ></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" ></script>
<script src="https://cdn.datatables.net/select/1.2.5/js/dataTables.select.min.js" ></script>
<h3><a href="http://www.gyrocode.com/articles/jquery-datatables-checkboxes/">jQuery DataTables – Row selection using checkboxes</a> <small>(HTML sourced data)</small></h3>
<a href="http://www.gyrocode.com/articles/jquery-datatables-checkboxes/">See full article on Gyrocode.com</a>
<hr><br>
   <style>
   table.dataTable.select tbody tr,
table.dataTable thead th:first-child {
  cursor: pointer;
}
</style>   
<form id="frm-example" action="/nosuchpage" method="POST">
    
<table id="example" class="display select" cellspacing="0" width="100%">
   <thead>
      <tr>
         <th><input name="select_all" value="1" type="checkbox"></th>
         <th>Name</th>
         <th>Position</th>
         <th>Office</th>
         <th>Extn.</th>
         <th>Start date</th>
         <th>Salary</th>
      </tr>
   </thead>
   <tfoot>
      <tr>
         <th></th>
         <th>Name</th>
         <th>Position</th>
         <th>Office</th>
         <th>Extn.</th>
         <th>Start date</th>
         <th>Salary</th>
      </tr>
   </tfoot>
   <tbody>
       <tr>
           <td>1</td>
           <td>Tiger Nixon</td>
           <td>System Architect</td>
           <td>Edinburgh</td>
           <td>61</td>
           <td>2011/04/25</td>
           <td>$320,800</td>
       </tr>
       <tr>
           <td>2</td>
           <td>Garrett Winters</td>
           <td>Accountant</td>
           <td>Tokyo</td>
           <td>63</td>
           <td>2011/07/25</td>
           <td>$170,750</td>
       </tr>
       <tr>
           <td>3</td>
           <td>Ashton Cox</td>
           <td>Junior Technical Author</td>
           <td>San Francisco</td>
           <td>66</td>
           <td>2009/01/12</td>
           <td>$86,000</td>
       </tr>
       <tr>
           <td>4</td>
           <td>Cedric Kelly</td>
           <td>Senior Javascript Developer</td>
           <td>Edinburgh</td>
           <td>22</td>
           <td>2012/03/29</td>
           <td>$433,060</td>
       </tr>
       <tr>
           <td>5</td>
           <td>Airi Satou</td>
           <td>Accountant</td>
           <td>Tokyo</td>
           <td>33</td>
           <td>2008/11/28</td>
           <td>$162,700</td>
       </tr>
       <tr>
           <td>6</td>
           <td>Brielle Williamson</td>
           <td>Integration Specialist</td>
           <td>New York</td>
           <td>61</td>
           <td>2012/12/02</td>
           <td>$372,000</td>
       </tr>
       <tr>
           <td>7</td>
           <td>Herrod Chandler</td>
           <td>Sales Assistant</td>
           <td>San Francisco</td>
           <td>59</td>
           <td>2012/08/06</td>
           <td>$137,500</td>
       </tr>
       <tr>
           <td>8</td>
           <td>Rhona Davidson</td>
           <td>Integration Specialist</td>
           <td>Tokyo</td>
           <td>55</td>
           <td>2010/10/14</td>
           <td>$327,900</td>
       </tr>
       <tr>
           <td>9</td>
           <td>Colleen Hurst</td>
           <td>Javascript Developer</td>
           <td>San Francisco</td>
           <td>39</td>
           <td>2009/09/15</td>
           <td>$205,500</td>
       </tr>
       <tr>
           <td>10</td>
           <td>Sonya Frost</td>
           <td>Software Engineer</td>
           <td>Edinburgh</td>
           <td>23</td>
           <td>2008/12/13</td>
           <td>$103,600</td>
       </tr>
       <tr>
           <td>11</td>
           <td>Jena Gaines</td>
           <td>Office Manager</td>
           <td>London</td>
           <td>30</td>
           <td>2008/12/19</td>
           <td>$90,560</td>
       </tr>
       <tr>
           <td>12</td>
           <td>Quinn Flynn</td>
           <td>Support Lead</td>
           <td>Edinburgh</td>
           <td>22</td>
           <td>2013/03/03</td>
           <td>$342,000</td>
       </tr>
       <tr>
           <td>13</td>
           <td>Charde Marshall</td>
           <td>Regional Director</td>
           <td>San Francisco</td>
           <td>36</td>
           <td>2008/10/16</td>
           <td>$470,600</td>
       </tr>
       <tr>
           <td>14</td>
           <td>Haley Kennedy</td>
           <td>Senior Marketing Designer</td>
           <td>London</td>
           <td>43</td>
           <td>2012/12/18</td>
           <td>$313,500</td>
       </tr>
       <tr>
           <td>15</td>
           <td>Tatyana Fitzpatrick</td>
           <td>Regional Director</td>
           <td>London</td>
           <td>19</td>
           <td>2010/03/17</td>
           <td>$385,750</td>
       </tr>
       <tr>
           <td>16</td>
           <td>Michael Silva</td>
           <td>Marketing Designer</td>
           <td>London</td>
           <td>66</td>
           <td>2012/11/27</td>
           <td>$198,500</td>
       </tr>
       <tr>
           <td>17</td>
           <td>Paul Byrd</td>
           <td>Chief Financial Officer (CFO)</td>
           <td>New York</td>
           <td>64</td>
           <td>2010/06/09</td>
           <td>$725,000</td>
       </tr>
       <tr>
           <td>18</td>
           <td>Gloria Little</td>
           <td>Systems Administrator</td>
           <td>New York</td>
           <td>59</td>
           <td>2009/04/10</td>
           <td>$237,500</td>
       </tr>
       <tr>
           <td>19</td>
           <td>Bradley Greer</td>
           <td>Software Engineer</td>
           <td>London</td>
           <td>41</td>
           <td>2012/10/13</td>
           <td>$132,000</td>
       </tr>
       <tr>
           <td>20</td>
           <td>Dai Rios</td>
           <td>Personnel Lead</td>
           <td>Edinburgh</td>
           <td>35</td>
           <td>2012/09/26</td>
           <td>$217,500</td>
       </tr>
       <tr>
           <td>21</td>
           <td>Jenette Caldwell</td>
           <td>Development Lead</td>
           <td>New York</td>
           <td>30</td>
           <td>2011/09/03</td>
           <td>$345,000</td>
       </tr>
       <tr>
           <td>22</td>
           <td>Yuri Berry</td>
           <td>Chief Marketing Officer (CMO)</td>
           <td>New York</td>
           <td>40</td>
           <td>2009/06/25</td>
           <td>$675,000</td>
       </tr>
       <tr>
           <td>23</td>
           <td>Caesar Vance</td>
           <td>Pre-Sales Support</td>
           <td>New York</td>
           <td>21</td>
           <td>2011/12/12</td>
           <td>$106,450</td>
       </tr>
       <tr>
           <td>24</td>
           <td>Doris Wilder</td>
           <td>Sales Assistant</td>
           <td>Sidney</td>
           <td>23</td>
           <td>2010/09/20</td>
           <td>$85,600</td>
       </tr>
       <tr>
           <td>25</td>
           <td>Angelica Ramos</td>
           <td>Chief Executive Officer (CEO)</td>
           <td>London</td>
           <td>47</td>
           <td>2009/10/09</td>
           <td>$1,200,000</td>
       </tr>
       <tr>
           <td>26</td>
           <td>Gavin Joyce</td>
           <td>Developer</td>
           <td>Edinburgh</td>
           <td>42</td>
           <td>2010/12/22</td>
           <td>$92,575</td>
       </tr>
       <tr>
           <td>27</td>
           <td>Jennifer Chang</td>
           <td>Regional Director</td>
           <td>Singapore</td>
           <td>28</td>
           <td>2010/11/14</td>
           <td>$357,650</td>
       </tr>
       <tr>
           <td>28</td>
           <td>Brenden Wagner</td>
           <td>Software Engineer</td>
           <td>San Francisco</td>
           <td>28</td>
           <td>2011/06/07</td>
           <td>$206,850</td>
       </tr>
       <tr>
           <td>29</td>
           <td>Fiona Green</td>
           <td>Chief Operating Officer (COO)</td>
           <td>San Francisco</td>
           <td>48</td>
           <td>2010/03/11</td>
           <td>$850,000</td>
       </tr>
       <tr>
           <td>30</td>
           <td>Shou Itou</td>
           <td>Regional Marketing</td>
           <td>Tokyo</td>
           <td>20</td>
           <td>2011/08/14</td>
           <td>$163,000</td>
       </tr>
       <tr>
           <td>31</td>
           <td>Michelle House</td>
           <td>Integration Specialist</td>
           <td>Sidney</td>
           <td>37</td>
           <td>2011/06/02</td>
           <td>$95,400</td>
       </tr>
       <tr>
           <td>32</td>
           <td>Suki Burks</td>
           <td>Developer</td>
           <td>London</td>
           <td>53</td>
           <td>2009/10/22</td>
           <td>$114,500</td>
       </tr>
       <tr>
           <td>33</td>
           <td>Prescott Bartlett</td>
           <td>Technical Author</td>
           <td>London</td>
           <td>27</td>
           <td>2011/05/07</td>
           <td>$145,000</td>
       </tr>
       <tr>
           <td>34</td>
           <td>Gavin Cortez</td>
           <td>Team Leader</td>
           <td>San Francisco</td>
           <td>22</td>
           <td>2008/10/26</td>
           <td>$235,500</td>
       </tr>
       <tr>
           <td>35</td>
           <td>Martena Mccray</td>
           <td>Post-Sales support</td>
           <td>Edinburgh</td>
           <td>46</td>
           <td>2011/03/09</td>
           <td>$324,050</td>
       </tr>
       <tr>
           <td>36</td>
           <td>Unity Butler</td>
           <td>Marketing Designer</td>
           <td>San Francisco</td>
           <td>47</td>
           <td>2009/12/09</td>
           <td>$85,675</td>
       </tr>
       <tr>
           <td>37</td>
           <td>Howard Hatfield</td>
           <td>Office Manager</td>
           <td>San Francisco</td>
           <td>51</td>
           <td>2008/12/16</td>
           <td>$164,500</td>
       </tr>
       <tr>
           <td>38</td>
           <td>Hope Fuentes</td>
           <td>Secretary</td>
           <td>San Francisco</td>
           <td>41</td>
           <td>2010/02/12</td>
           <td>$109,850</td>
       </tr>
       <tr>
           <td>39</td>
           <td>Vivian Harrell</td>
           <td>Financial Controller</td>
           <td>San Francisco</td>
           <td>62</td>
           <td>2009/02/14</td>
           <td>$452,500</td>
       </tr>
       <tr>
           <td>40</td>
           <td>Timothy Mooney</td>
           <td>Office Manager</td>
           <td>London</td>
           <td>37</td>
           <td>2008/12/11</td>
           <td>$136,200</td>
       </tr>
       <tr>
           <td>41</td>
           <td>Jackson Bradshaw</td>
           <td>Director</td>
           <td>New York</td>
           <td>65</td>
           <td>2008/09/26</td>
           <td>$645,750</td>
       </tr>
       <tr>
           <td>42</td>
           <td>Olivia Liang</td>
           <td>Support Engineer</td>
           <td>Singapore</td>
           <td>64</td>
           <td>2011/02/03</td>
           <td>$234,500</td>
       </tr>
       <tr>
           <td>43</td>
           <td>Bruno Nash</td>
           <td>Software Engineer</td>
           <td>London</td>
           <td>38</td>
           <td>2011/05/03</td>
           <td>$163,500</td>
       </tr>
       <tr>
           <td>44</td>
           <td>Sakura Yamamoto</td>
           <td>Support Engineer</td>
           <td>Tokyo</td>
           <td>37</td>
           <td>2009/08/19</td>
           <td>$139,575</td>
       </tr>
       <tr>
           <td>45</td>
           <td>Thor Walton</td>
           <td>Developer</td>
           <td>New York</td>
           <td>61</td>
           <td>2013/08/11</td>
           <td>$98,540</td>
       </tr>
       <tr>
           <td>46</td>
           <td>Finn Camacho</td>
           <td>Support Engineer</td>
           <td>San Francisco</td>
           <td>47</td>
           <td>2009/07/07</td>
           <td>$87,500</td>
       </tr>
       <tr>
           <td>47</td>
           <td>Serge Baldwin</td>
           <td>Data Coordinator</td>
           <td>Singapore</td>
           <td>64</td>
           <td>2012/04/09</td>
           <td>$138,575</td>
       </tr>
       <tr>
           <td>48</td>
           <td>Zenaida Frank</td>
           <td>Software Engineer</td>
           <td>New York</td>
           <td>63</td>
           <td>2010/01/04</td>
           <td>$125,250</td>
       </tr>
       <tr>
           <td>49</td>
           <td>Zorita Serrano</td>
           <td>Software Engineer</td>
           <td>San Francisco</td>
           <td>56</td>
           <td>2012/06/01</td>
           <td>$115,000</td>
       </tr>
       <tr>
           <td>50</td>
           <td>Jennifer Acosta</td>
           <td>Junior Javascript Developer</td>
           <td>Edinburgh</td>
           <td>43</td>
           <td>2013/02/01</td>
           <td>$75,650</td>
       </tr>
       <tr>
           <td>51</td>
           <td>Cara Stevens</td>
           <td>Sales Assistant</td>
           <td>New York</td>
           <td>46</td>
           <td>2011/12/06</td>
           <td>$145,600</td>
       </tr>
       <tr>
           <td>52</td>
           <td>Hermione Butler</td>
           <td>Regional Director</td>
           <td>London</td>
           <td>47</td>
           <td>2011/03/21</td>
           <td>$356,250</td>
       </tr>
       <tr>
           <td>53</td>
           <td>Lael Greer</td>
           <td>Systems Administrator</td>
           <td>London</td>
           <td>21</td>
           <td>2009/02/27</td>
           <td>$103,500</td>
       </tr>
       <tr>
           <td>54</td>
           <td>Jonas Alexander</td>
           <td>Developer</td>
           <td>San Francisco</td>
           <td>30</td>
           <td>2010/07/14</td>
           <td>$86,500</td>
       </tr>
       <tr>
           <td>55</td>
           <td>Shad Decker</td>
           <td>Regional Director</td>
           <td>Edinburgh</td>
           <td>51</td>
           <td>2008/11/13</td>
           <td>$183,000</td>
       </tr>
       <tr>
           <td>56</td>
           <td>Michael Bruce</td>
           <td>Javascript Developer</td>
           <td>Singapore</td>
           <td>29</td>
           <td>2011/06/27</td>
           <td>$183,000</td>
       </tr>
       <tr>
           <td>57</td>
           <td>Donna Snider</td>
           <td>Customer Support</td>
           <td>New York</td>
           <td>27</td>
           <td>2011/01/25</td>
           <td>$112,000</td>
       </tr>
   </tbody>
</table>
<hr>

<p>Press <b>Submit</b> and check console for URL-encoded form data that would be submitted.</p>

<p><button>Submit</button></p>

<b>Data submitted to the server:</b><br>
<pre id="example-console">
</pre>
</form>

<script>
//
// Updates "Select all" control in a data table
//
function updateDataTableSelectAllCtrl(table){
   var $table             = table.table().node();
   var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
   var $chkbox_checked    = $('tbody input[type="checkbox"]:checked', $table);
   var chkbox_select_all  = $('thead input[name="select_all"]', $table).get(0);

   // If none of the checkboxes are checked
   if($chkbox_checked.length === 0){
      chkbox_select_all.checked = false;
      if('indeterminate' in chkbox_select_all){
         chkbox_select_all.indeterminate = false;
      }

   // If all of the checkboxes are checked
   } else if ($chkbox_checked.length === $chkbox_all.length){
      chkbox_select_all.checked = true;
      if('indeterminate' in chkbox_select_all){
         chkbox_select_all.indeterminate = false;
      }

   // If some of the checkboxes are checked
   } else {
      chkbox_select_all.checked = true;
      if('indeterminate' in chkbox_select_all){
         chkbox_select_all.indeterminate = true;
      }
   }
}

$(document).ready(function (){
   // Array holding selected row IDs
   var rows_selected = [];
   var table = $('#example').DataTable({
      'columnDefs': [{
         'targets': 0,
         'searchable':false,
         'orderable':false,
         'className': 'dt-body-center',
         'render': function (data, type, full, meta){
             return '<input type="checkbox">';
         }
      }],
      'order': [1, 'asc'],
      'rowCallback': function(row, data, dataIndex){
         // Get row ID
         var rowId = data[0];

         // If row ID is in the list of selected row IDs
         if($.inArray(rowId, rows_selected) !== -1){
            $(row).find('input[type="checkbox"]').prop('checked', true);
            $(row).addClass('selected');
         }
      }
   });

   // Handle click on checkbox
   $('#example tbody').on('click', 'input[type="checkbox"]', function(e){
      var $row = $(this).closest('tr');

      // Get row data
      var data = table.row($row).data();

      // Get row ID
      var rowId = data[0];

      // Determine whether row ID is in the list of selected row IDs 
      var index = $.inArray(rowId, rows_selected);

      // If checkbox is checked and row ID is not in list of selected row IDs
      if(this.checked && index === -1){
         rows_selected.push(rowId);

      // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
      } else if (!this.checked && index !== -1){
         rows_selected.splice(index, 1);
      }

      if(this.checked){
         $row.addClass('selected');
      } else {
         $row.removeClass('selected');
      }

      // Update state of "Select all" control
      updateDataTableSelectAllCtrl(table);

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle click on table cells with checkboxes
   $('#example').on('click', 'tbody td, thead th:first-child', function(e){
      $(this).parent().find('input[type="checkbox"]').trigger('click');
   });

   // Handle click on "Select all" control
   $('thead input[name="select_all"]', table.table().container()).on('click', function(e){
      if(this.checked){
         $('tbody input[type="checkbox"]:not(:checked)', table.table().container()).trigger('click');
      } else {
         $('tbody input[type="checkbox"]:checked', table.table().container()).trigger('click');
      }

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle table draw event
   table.on('draw', function(){
      // Update state of "Select all" control
      updateDataTableSelectAllCtrl(table);
   });
    
   // Handle form submission event 
   $('#frm-example').on('submit', function(e){
      var form = this;

      // Iterate over all selected checkboxes
      $.each(rows_selected, function(index, rowId){
         // Create a hidden element 
         $(form).append(
             $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'id[]')
                .val(rowId)
         );
      });

      // FOR DEMONSTRATION ONLY     
      
      // Output form data to a console     
      $('#example-console').text($(form).serialize());
      console.log("Form submission", $(form).serialize());
       
      // Remove added elements
      $('input[name="id\[\]"]', form).remove();
       
      // Prevent actual form submission
      e.preventDefault();
   });
});
</script>