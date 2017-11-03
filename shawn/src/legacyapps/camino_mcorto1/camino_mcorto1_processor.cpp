#include "legacyapps/camino_mcorto1/camino_mcorto1_processor.h"
#ifdef ENABLE_CAMINO_MCORTO1

#include "legacyapps/camino_mcorto1/camino_mcorto1_message.h"
#include "sys/simulation/simulation_controller.h"
#include "sys/node.h"
#include <iostream>


namespace camino_mcorto1
{
   camino_mcorto1Processor::
   camino_mcorto1Processor()
   {}

   camino_mcorto1Processor::
   ~camino_mcorto1Processor()
   {}
   
   void
   camino_mcorto1Processor::
   boot( void )
      throw()
   {}
   
   bool
   camino_mcorto1Processor::
   process_message( const shawn::ConstMessageHandle& mh ) 
      throw()
   {
      const camino_mcorto1Message* msg = 
          dynamic_cast<const camino_mcorto1Message*>( mh.get() );

      if( msg != NULL )
      { 
         if( owner() != msg->source() )
         { 
            /*neighbours_.insert( &msg->source() );
            INFO( logger(), "Nodo ID: "<< owner().label()<< " Recibió un mensaje de '" 
                            << msg->source().label() 
                            << "'" );*/
		neighbours_.insert( &msg->source() );
			    INFO( logger(), "Recibió un mensaje de '" 
				            << msg->source().label() 
				            << "'" );
         }
         return true;
      }

      return Processor::process_message( mh );
   }
   
   void
   camino_mcorto1Processor::
   work( void )
      throw()
   {
      // send message only in the first simulation round
      if ( simulation_round() == 0 )
      { 
         send( new camino_mcorto1Message );
      }
   }
}
#endif
