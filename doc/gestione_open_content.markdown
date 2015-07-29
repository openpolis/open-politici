Specifiche per l'interfaccia di gestione degli open content
===========================================================

Requisiti
---------
La vendita dei dati di Openpolis a terze parti, obbliga a un controllo puntuale della validità
dei dati inseriti nel sistema.

La verifica viene fatta da una redazione interna, ma gli *open content* devono continuare a poter essere 
inseriti nel sistema dagli utenti registrati.

La redazione ha necessità di un'interfaccia di backend che permetta:

* la visualizzazione degli inserimenti, ordinati per data e filtrati con vari criteri
* la verifica di un inserimento, con accettazione o rifiuto, da parte di un redattore
* la visualizzazione di chi ha verificato l'inserimento, con data

L'interfaccia deve poter essere utilizzata da più persone contemporaneamente. 
Il lavoro svolto da una persona deve immediatamente essere visibile agli altri membri del team.

Le modifiche devono essere reversibili, da parte di tutti i membri del team o di un super-redattore (a scelta).

Gli inserimenti di tipo *open content* riguardano:

* le cariche (istituzionali, politiche e in organizzazioni)
* le risorse (email e siti web)
* gli *opinable content*:

  * dichiarazioni
  * commenti
  * rilevanza

Tra gli opinable content, il controllo riguarda solamente le dichiarazioni.

Architettura delle informazioni
-------------------------------
L'interfaccia è composta da un elenco di inserimenti, ordinati per data (`op_content.created_at`).
Per ciascuna voce dell'elenco, sono presenti questi campi:
 
 * tipo (incarico [istituzionale, politico, organizzativo], risorsa [email, url], dichiarazione)
 * politico cui si riferisce il contenuto (linkato alla sua scheda di carriera e risorse)
 * descrizione (un testo che descrive in modo estensivo l'inserimento: descrizione estesa incarico, data inizio e fine, ...)
 * momento dell'inserimento in formato d/m/Y H:i (`op_content.created_at`)
 * status (da verificare, accettato, respinto) (linkato alla eventuale storia delle modifiche, se esiste)
 * verificato il (formato d/m/Y H:i)
 
e queste azioni:

 * accetta: mette l'inserimento nello status accettato
 * rifiuta: mette l'inserimento nello status rifiutato
 * segnala: invia una notifica al capo redattore (senza toccare lo status)

Le azioni accetta e rifiuta sono attive quando lo status è diverso da accettato e rifiutato, rispettivamente.
Le azioni possono essere batch (see: [here][sf10-batch-actions-patch]) 

Cliccando sul campo `politico` si va alla visualizzazione della scheda ddel singolo politico, con il dettaglio 
della sua carriera (elenco di incarichi) e delle sue risorse e dichiarazioni (tab).
Ciascuna può essere verificata manualmente (anche qui, batch actions).


[sf10-batch-actions-patch]:http://trac.symfony-project.org/attachment/ticket/2100/batch_actions.patch

Variazioni al DB
----------------
Va aggiunto il campo `verified_at` alla `op_open_content`, che tiene traccia delle verifiche.
Il campo ha valore di default null.
In una fase di setup, vengono posti al valore del campo `deleted_at` tutti i campi `verified_at` dei record oscurati
`update op_content set verified_at=deleted_at where deleted_at is not null;`

Va aggiunta la tabella `op_open_content_verification`, per tener traccia della storia degli interventi.

 * `content_id` - fk non obbl. a `op_open_content`
 * `user_id` - fk non obbl. a `op_user`
 * `created_at` - data intervento di verifica
 * `operation` - tipo di intervento [ACCEPTED | REJECTED]

Dettagli progettuali
--------------------
L'interfaccia di backend potrebbe essere quella generata automaticamente a partire dalla tabella `op_open_content`.
Occorrono delle variazioni:

 * l'estrazione dei dati deve mettere in join la `op_content`, per avere a disposizione il campo `created_at`
 * sono estratti solo i dati da verificare (`verified_at is null`)
 * per estrarre le descrizioni occorrono join con tabelle differenti (`inner_join`?)

Le azioni che estraggono gli update per `op_rcs` possono, a questo punto, tener conto dei dati verificati ed estrarre solo le novità verificate, ossia quelle per cui il campo `verified_at` non è null.

Le interfacce di verifica e gestione delle località (nel frontend) devono essere integrate. Anche lì deve essere possibile verificare un dato, se non lo è (attraverso checkbox).

L'interfaccia di gestione delle località va spostata nel backend, per attivare le batch actions.

Va verificato il funzionamento del motore di ricerca per l'aggiunta di incarichi a un politico.

Va verificata la modifica di un gruppo o partito, che secondo Vincenzo non funziona.

 
