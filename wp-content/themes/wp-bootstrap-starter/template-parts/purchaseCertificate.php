
	<body>
		<h2>Πιστοποιητικό Έρευνας Αγοράς</h2>
		<table class="certificateData">
		  <tr>
		    <th>Ημερομηνία εκτύπωσης πιστοποιητικού:</th>
		    <th>@printDate</th>
		  </tr>
		  <tr>
		    <td>Ημερομηνία υποβολής αιτήματος προσφοράς:</td>
		    <td>@inquiryDate</td>
		  </tr>
		  <tr>
		    <td>Το αίτημα υποβλήθηκε από τον χρήστη:</td>
		    <td>@author</td>
		  </tr>
		  <tr>
		    <td>Η έρευνα αγοράς πραγματοποιήθηκε μέσω:</td>
		    <td></td>
		  </tr>
		  <tr>
		    <td>Η έρευνα αγοράς ξεκίνησε:</td>
		    <td></td>
		  </tr>
		  <tr>
		    <td>Η έρευνα αγοράς ολοκληρώθηκε:</td>
		    <td></td>
		  </tr>
		</table>
		<h4>Περιγραφή αιτήματος:</h4>
		<div class="col-xs-12 inquiryContent">
			@inquiryContent
		</div>
		<table class="inquiryAttachments">
		  <tr>
		    <th>Συνημμένα αρχεία αιτήματος προσφοράς:</th>
		    <th>//attachments</th>
		  </tr>
		</table>
		<h4>Προσφορά που επιλέχθηκε:</h4>
		<div class="col-xs-12 wonOffer">
			Επωνυμία: @won_offer_seller <br />
			Kόστος ανά τεμάχιο: @won_offer_unit_cost <br />
			Τεμάχια: @won_offer_units
		</div>
		<h4>Προσφορά που απορρίφθηκαν:</h4>
		<div class="col-xs-12 failedOffer">
			Επωνυμία: @failed_offer_seller <br />
			Kόστος ανά τεμάχιο: @failed_offer_unit_cost <br />
			Τεμάχια: @failed_offer_units
		</div>
	</body>
</html>
