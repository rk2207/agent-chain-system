<style type="text/css">
* {margin: 0; padding: 0;}

.tree ul {
	padding-top: 20px; position: relative;
	
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
}

.tree li {
	float: left; text-align: center;
	list-style-type: none;
	position: relative;
	padding: 20px 5px 0 5px;
	
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
}

/*We will use ::before and ::after to draw the connectors*/

.tree li::before, .tree li::after{
	content: '';
	position: absolute; top: 0; right: 50%;
	border-top: 1px solid #ccc;
	width: 50%; height: 20px;
}
.tree li::after{
	right: auto; left: 50%;
	border-left: 1px solid #ccc;
}

/*We need to remove left-right connectors from elements without 
any siblings*/
.tree li:only-child::after, .tree li:only-child::before {
	display: none;
}

/*Remove space from the top of single children*/
.tree li:only-child{ padding-top: 0;}

/*Remove left connector from first child and 
right connector from last child*/
.tree li:first-child::before, .tree li:last-child::after{
	border: 0 none;
}
/*Adding back the vertical connector to the last nodes*/
.tree li:last-child::before{
	border-right: 1px solid #ccc;
	border-radius: 0 5px 0 0;
	-webkit-border-radius: 0 5px 0 0;
	-moz-border-radius: 0 5px 0 0;
}
.tree li:first-child::after{
	border-radius: 5px 0 0 0;
	-webkit-border-radius: 5px 0 0 0;
	-moz-border-radius: 5px 0 0 0;
}

/*Time to add downward connectors from parents*/
.tree ul ul::before{
	content: '';
	position: absolute; top: 0; left: 50%;
	border-left: 1px solid #ccc;
	width: 0; height: 20px;
}

.tree li a{
	border: 1px solid #ccc;
	padding: 5px 10px;
	text-decoration: none;
	color: #666;
	font-family: arial, verdana, tahoma;
	font-size: 11px;
	display: inline-block;
	
	border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
}

/*Time for some hover effects*/
/*We will apply the hover effect the the lineage of the element also*/
.tree li a:hover, .tree li a:hover+ul li a {
	background: #c8e4f8; color: #000; border: 1px solid #94a0b4;
}
/*Connector styles on hover*/
.tree li a:hover+ul li::after, 
.tree li a:hover+ul li::before, 
.tree li a:hover+ul::before, 
.tree li a:hover+ul ul::before{
	border-color:  #94a0b4;
}

</style>

<div class="tree">
   <ul>
   <li>
      <a href=''>1272129311</a>
      <ul>
         <li>
            <ul>				
				<li>
                  <ul>	
					<li>
					  <a href=''>1349404179</a>
					  <ul>
						 <li>
							<ul>
							   <li>
								  <a href=''>1377239554</a>
								  <ul>
									 <li>
										<ul>
										   <li>
											  <a href=''>1268069415</a>
											  <ul></ul>
										   </li>
										   <li>
											  <a href=''>1198376060</a>
											  <ul></ul>
										   </li>
										</ul>
									 </li>
									 <li>
										<ul>
										   <li>
											  <a href=''>9092703134</a>
											  <ul>
												 <li>
													<ul>
													   <li>
														  <a href=''>1503744518</a>
														  <ul></ul>
													   </li>
													   <li>
														  <a href=''>1503744520</a>
														  <ul></ul>
													   </li>
													</ul>
												 </li>
											  </ul>
										   </li>
										   <li>
											  <a href=''>9781228361</a>
											  <ul></ul>
										   </li>
										</ul>
									 </li>
								  </ul>
							   </li>
							   <li>
								  <a href=''>1262896469</a>
								  <ul>
									 <li>
										<ul>
										   <li>
											  <a href=''>1351092001</a>
											  <ul></ul>
										   </li>
										   <li>
											  <a href=''>1372632257</a>
											  <ul></ul>
										   </li>
										</ul>
									 </li>
								  </ul>
							   </li>
							</ul>
						 </li>
					  </ul>
				   </li>
					<li>
					  <a href=''>1307938503</a>
					  <ul>
						 <li>
							<ul>
							   <li>
								  <a href=''>1132897697</a>
								  <ul>
									 <li>
										<ul>
										   <li>
											  <a href=''>1311633464</a>
											  <ul></ul>
										   </li>
										   <li>
											  <a href=''>1392475567</a>
											  <ul></ul>
										   </li>
										</ul>
									 </li>
								  </ul>
							   </li>
							   <li>
								  <a href=''>1374219722</a>
								  <ul>
									 <li>
										<ul>
										   <li>
											  <a href=''>1291625934</a>
											  <ul></ul>
										   </li>
										   <li>
											  <a href=''>1196898075</a>
											  <ul></ul>
										   </li>
										</ul>
									 </li>
									 <li>
										<ul>
										   <li>
											  <a href=''>2742255872</a>
											  <ul></ul>
										   </li>
										</ul>
									 </li>
								  </ul>
							   </li>
							</ul>
						 </li>
					  </ul>
				   </li>
				  </ul>
				</li>
				<li>
                  <ul>
                     <li>
                        <a href=''>1188449843</a>
                        <ul>
                           <li>
                              <ul>
                                 <li>
                                    <a href=''>1179746156</a>
                                    <ul>
                                       <li>
                                          <ul>
                                             <li>
                                                <a href=''>1215619212</a>
                                                <ul></ul>
                                             </li>
                                             <li>
                                                <a href=''>1371637810</a>
                                                <ul></ul>
                                             </li>
                                          </ul>
                                       </li>
                                    </ul>
                                 </li>
                                 <li>
                                    <a href=''>1329195935</a>
                                    <ul>
                                       <li>
                                          <ul>
                                             <li>
                                                <a href=''>1249476005</a>
                                                <ul></ul>
                                             </li>
                                             <li>
                                                <a href=''>1292401419</a>
                                                <ul></ul>
                                             </li>
                                          </ul>
                                       </li>
                                    </ul>
                                 </li>
                              </ul>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a href=''>1184846115</a>
                        <ul>
                           <li>
                              <ul>
                                 <li>
                                    <a href=''>1228118217</a>
                                    <ul>
                                       <li>
                                          <ul>
                                             <li>
                                                <a href=''>1313914305</a>
                                                <ul></ul>
                                             </li>
                                             <li>
                                                <a href=''>1145944103</a>
                                                <ul></ul>
                                             </li>
                                          </ul>
                                       </li>
                                    </ul>
                                 </li>
                                 <li>
                                    <a href=''>1192546232</a>
                                    <ul>
                                       <li>
                                          <ul>
                                             <li>
                                                <a href=''>1220700924</a>
                                                <ul></ul>
                                             </li>
                                             <li>
                                                <a href=''>1154802887</a>
                                                <ul></ul>
                                             </li>
                                          </ul>
                                       </li>
                                    </ul>
                                 </li>
                              </ul>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </li>
				<!--<li>
					<ul>
                     <li>
                        <a href=''>1188449843</a>
                        <ul>
						</ul>
					 </li>
					</ul>
						
				</li>-->
			</ul>
         </li>
      </ul>
</div>