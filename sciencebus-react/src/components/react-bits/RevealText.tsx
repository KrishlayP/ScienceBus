import { motion } from 'framer-motion'
import type { ReactNode } from 'react'

type RevealTextProps = {
  children: ReactNode
  delay?: number
  className?: string
}

export function RevealText({ children, delay = 0, className = '' }: RevealTextProps) {
  return (
    <motion.span
      className={`inline-block ${className}`}
      initial={{ opacity: 0, y: 18, filter: 'blur(10px)' }}
      animate={{ opacity: 1, y: 0, filter: 'blur(0px)' }}
      transition={{ delay, duration: 0.7, ease: [0.22, 1, 0.36, 1] }}
    >
      {children}
    </motion.span>
  )
}
