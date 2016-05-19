<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<div id="searchForm">
                    <h2>Save big, Shop big <br/></h2>
                    <button onclick ="submitSearch();" name="submit" class="submit">Search</button>
                    <input type="text" name="search" class="search" id="searchBox" value="" placeholder="Please enter a keyword"/>
                    
		</div>
                <!-- </form>-->
            <div id="searchInDiv">
                <fieldset>
                    <legend>Search in?</legend>
                            <input id="ebay" type="checkbox" name="searchIn[]" value="Ebay" />Ebay 
                            <input type="checkbox" name="searchIn[]" value="Amazon" />Amazon
                </fieldset>
            </div>