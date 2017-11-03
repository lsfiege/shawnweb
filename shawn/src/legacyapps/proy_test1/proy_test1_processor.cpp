#include "legacyapps/proy_test1/proy_test1_processor.h"
#ifdef ENABLE_PROY_TEST1

#include "legacyapps/proy_test1/proy_test1_message.h"
#include "sys/simulation/simulation_controller.h"
#include "sys/node.h"
#include <iostream>


namespace proy_test1
{
   proy_test1Processor::
   proy_test1Processor()
   {}

   proy_test1Processor::
   ~proy_test1Processor()
   {}
   
   void
   proy_test1Processor::
   boot( void )
      throw()
   {}
   
   bool
   proy_test1Processor::
   process_message( const shawn::ConstMessageHandle& mh ) 
      throw()
   {
      const proy_test1Message* msg = 
          dynamic_cast<const proy_test1Message*>( mh.get() );

      if( msg != NULL )
      { 
         if( owner() != msg->source() )
         { 
            
	    neighbours_.insert( &msg->source() );
            INFO( logger(), "Nodo ID: "<< owner().label()<< " Recibió un mensaje de '" 
                            << msg->source().label() 
                            << "'" );

		/*neighbours_.insert( &msg->source() );
			    INFO( logger(), "Recibió un mensaje de '" 
				            << msg->source().label() 
				            << "'" );*/
         }
         return true;
      }

      return Processor::process_message( mh );
   }
   
   void
   proy_test1Processor::
   work( void )
      throw()
   {
      // send message only in the first simulation round
      if ( simulation_round() == 0 )
      { 
         send( new proy_test1Message );
      }
   }
}
#endif